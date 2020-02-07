<?php

namespace App\Http\Controllers\Setup\Brand;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\BrandEntryRequest;
use App\Backend\Infrastructure\Forms\BrandEditRequest;
use App\Setup\Brand\BrandRepositoryInterface;
use App\Setup\Brand\Brand;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use image;

class BrandController extends Controller
{
    private $repo;

    public function __construct(BrandRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $brands      = $this->repo->getObjsAll();
            return view('backend.brand.index')->with('brands',$brands);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.brand.brand');
        }
        return redirect('/');
    }

    public function store(BrandEntryRequest $request)
    {
        $validated                      = $request->validated();
        $brand_name                      = Input::get('name');
        $code                           = Input::get('code');
        $image_url_name                 = "";
        $display_order                  = Input::get('display_order'); 
        $detail_info                    = Input::get('detail_info');
        $description                    = Input::get('description');
        $remark                         = Input::get('remark');
        $status                         = Input::get('status');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/brand/';

        if(Input::hasFile('image_url'))
        {
            $image_url        = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext      = Utility::getImageExt($image_url);
            $image_url_name     = uniqid() . "." . $image_url_ext;
            $image          = Utility::resizeImage($image_url,$image_url_name,$path);
        }
        else{
            $image_url_name = "";
        }

        if($removeImageFlag == 1){
            $image_url_name = "";
        }
        //End Saving Image

        $paramObj = new Brand();
        $paramObj->name         = $brand_name;
        $paramObj->code         = $code;
        $paramObj->image_url    = '/images/brand/' . $image_url_name;
        $paramObj->display_order = $display_order;
        $paramObj->detail_info  = $detail_info;
        $paramObj->description  = $description;
        $paramObj->remark       = $remark;
        $paramObj->status       = $status;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Brand\BrandController@index')
                ->with(FormatGenerator::message('Success', 'Brand is created ...'));
        }
        else{
            return redirect()->action('Setup\Brand\BrandController@index')
                ->with(FormatGenerator::message('Fail', 'Brand is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $brand        = Brand::find($id);
            return view('backend.brand.brand')->with('obj', $brand);
        }
        return redirect('/backend_app/login');
    }

    public function update(BrandEditRequest $request){
        
        $validated                      = $request->validated();
        $id                             = Input::get('id');
        $brand_name                      = Input::get('name');
        $code                           = Input::get('code');
        $display_order                  = Input::get('display_order'); 
        $detail_info                    = Input::get('detail_info');
        $description                    = Input::get('description');
        $remark                         = Input::get('remark');
        $status                         = Input::get('status');
        
        $removeImageFlag                = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                           = base_path().'/public/images/brand/';        
        $remove_old_image               = false;

        $paramObj                       = Brand::find($id);
        $old_image                      = $paramObj->image_url;
        $paramObj->name                 = $brand_name;
        $paramObj->code                 = $code;
        $paramObj->display_order        = $display_order;
        $paramObj->detail_info          = $detail_info;
        $paramObj->description          = $description;
        $paramObj->remark               = $remark;
        $paramObj->status               = $status;

        if(Input::hasFile('image_url'))
        {   
            //Start Saving Image
            $image_url                  = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext              = Utility::getImageExt($image_url);
            $image_url_name             = uniqid() . "." . $image_url_ext;
            $image                      = Utility::resizeImage($image_url,$image_url_name,$path);
            $remove_old_image           = true;
            $paramObj->image_url        = '/images/brand/' . $image_url_name;
            //End Saving Image
        }
        else{
            if($removeImageFlag == 1){
                $paramObj->image_url    = "";
                $remove_old_image       = true;
            }
        }

        $result = $this->repo->update($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            // Delete the old image
            if($remove_old_image           == true){
                Utility::removeImage($old_image);
            }            

            return redirect()->action('Setup\Brand\BrandController@index')
                ->with(FormatGenerator::message('Success', 'Brand is updated ...'));
        }
        else{

            return redirect()->action('Setup\Brand\BrandController@index')
                ->with(FormatGenerator::message('Fail', 'Brand is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Brand\BrandController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Brand\BrandController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function check_brand_name(){
        $brand_name     = Input::get('brand_name');
        $country_id    = Input::get('country_id');
        $brand          = Brand::where('country_id','=',$country_id)->where('brand_name','=',$brand_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($brand) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
