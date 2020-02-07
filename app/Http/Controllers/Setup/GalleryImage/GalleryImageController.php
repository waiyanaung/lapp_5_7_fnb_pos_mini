<?php

namespace App\Http\Controllers\Setup\GalleryImage;

use App\Core\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\GalleryImageEntryRequest;
use App\Backend\Infrastructure\Forms\GalleryImageEditRequest;
use App\Setup\GalleryImage\GalleryImageRepositoryInterface;
use App\Setup\GalleryImage\GalleryImage;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use image;
use App\Log\LogCustom;

use App\Setup\Gallery\GalleryRepositoryInterface;
use App\Setup\Gallery\Gallery;

class GalleryImageController extends Controller
{
    private $repo;

    public function __construct(GalleryImageRepositoryInterface $repo)
    {
        $this->repo = $repo;
        
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $galleryimages      = $this->repo->getObjs();
            return view('backend.galleryimage.index')->with('galleryimages',$galleryimages);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.galleryimage.galleryimage');
        }
        return redirect('/');
    }

    public function store(GalleryImageEntryRequest $request)
    {
        $validated                  = $request->validated();
        $gallery_id                 = Input::get('gallery_id');

        //Start Saving Image
        $path         = base_path().'/public/images/galleryimage/';

        if(Input::hasFile('file'))
        {   
            $image_url        = Input::file('file');
            
            $galleryimage_name          = $_FILES["file"]["name"];            
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext              = Utility::getImageExt($image_url);
            $image_url_name             = uniqid() . "." . $image_url_ext;
            $image_name                 = str_replace(".".$image_url_ext, '', $galleryimage_name);
            $image                      = Utility::resizeImage($image_url,$image_url_name,$path);
        }
        else {
            return \Response::json(['error'=>'No files found for upload.']);
        }
        //End Saving Image

        $paramObj               = new GalleryImage();
        $paramObj->id           = uniqid();
        $paramObj->gallery_id   =  $gallery_id;
        $paramObj->image_url    = '/images/galleryimage/' . $image_url_name;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){
            return \Response::json(['Uploaded'=> $galleryimage_name]);           

            //return redirect()->action('Setup\GalleryImage\GalleryImageController@index')
            //    ->with(FormatGenerator::message('Success', 'GalleryImage is created ...'));
        }
        else{
            return \Response::json(['Error'=>'Error in image upload.']);
            //return redirect()->action('Setup\GalleryImage\GalleryImageController@index')
            //    ->with(FormatGenerator::message('Fail', 'GalleryImage is not created ...'));
        }

    }

    public function showAddImageForm($id)
    {
        if(Auth::check()) {
            $obj_gallery  = Gallery::find($id);
            $objs_galleryimages  = $this->repo->getByParentId($id);
            
            return view('backend.galleryimage.galleryimage_addimages')
                    ->with('obj_gallery',$obj_gallery)
                    ->with('objs_galleryimages',$objs_galleryimages);
        }
        return redirect('/backend_app/login');
    }

    public function edit($id)
    {
        if(Auth::check()) {
            $obj_gallery  = Gallery::find($id);
            $objs_galleryimages  = $this->repo->getByParentId($id);
            
            return view('backend.galleryimage.galleryimage')
                    ->with('obj_gallery',$obj_gallery)
                    ->with('objs_galleryimages',$objs_galleryimages);
        }
        return redirect('/backend_app/login');
    }

    public function update(GalleryImageEditRequest $request)
    {
        if(Auth::check()) {
            $validated = $request->validated();
            $gallery_id                      = Input::get('id');
            $result['laravelStatusCode'] =  ReturnMessage::INTERNAL_SERVER_ERROR;
            $currentUserID = Utility::getCurrentUserID(); //get currently logged in user
            
            if (Input::has('gallery_image_id')) {
                $arr_gallery_image_id                 = Input::get('gallery_image_id');
                foreach($arr_gallery_image_id as $key_gallery_image_id => $value_gallery_image){

                    // Delete gallery image
                    DB::delete("delete from gallery_image where id = '$key_gallery_image_id'");

                    // Delete the old image 
                    Utility::removeImage($key_gallery_image_id);

                    //create delete log
                    $date    = date("Y-m-d H:i:s");
                    $message = '['. $date .'] '. 'delete: ' . 'User '. $currentUserID .' deletedd a gallery image id ' . $key_gallery_image_id . ' --- of Gallery id - ' . $gallery_id . PHP_EOL;
                    LogCustom::create($date,$message);
                }
                $result['laravelStatusCode'] =  ReturnMessage::OK;                
            }
        
            if($result['laravelStatusCode'] ==  ReturnMessage::OK){                
            
                return redirect()->route('backend_app/galleryimage/edit',$gallery_id)
                    ->with(FormatGenerator::message('Success', 'Gallery Images are updated ...'));
            }
            else{            
                return redirect()->route('backend_app/galleryimage/edit',$gallery_id)
                    ->with(FormatGenerator::message('Fail', 'Gallery Images are not updated ...'));
            }
        }
        return redirect('/backend_app/login');
    }

    public function destroy(){
            
        
    }

    public function check_galleryimage_name(){
        $galleryimage_name     = Input::get('galleryimage_name');
        $country_id    = Input::get('country_id');
        $galleryimage          = GalleryImage::where('country_id','=',$country_id)->where('galleryimage_name','=',$galleryimage_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($galleryimage) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
