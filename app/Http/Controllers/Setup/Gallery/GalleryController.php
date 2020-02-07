<?php

namespace App\Http\Controllers\Setup\Gallery;

use App\Backend\Infrastructure\Forms\GalleryEditRequest;
use App\Backend\Infrastructure\Forms\GalleryEntryRequest;
use App\Core\Check;
use App\Core\FormatGenerator as FormatGenerator;
use App\Core\ReturnMessage as ReturnMessage;
use App\Core\Utility;
use App\Http\Controllers\Controller;
use App\Setup\Gallery\Gallery;
use App\Setup\Gallery\GalleryRepositoryInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GalleryController extends Controller
{
    private $repo;

    public function __construct(GalleryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            $gallerys = $this->repo->getObjsAll();
            return view('backend.gallery.index')->with('gallerys', $gallerys);
        }
        return redirect('/');
    }

    public function create()
    {
        if (Auth::check()) {
            return view('backend.gallery.gallery');
        }
        return redirect('/');
    }

    public function store(GalleryEntryRequest $request)
    {
        $validated = $request->validated();
        $gallery_name = Input::get('name');
        $code = Input::get('code');
        $image_url_name = "";
        $detail_info = Input::get('detail_info');
        $status = Input::get('status');

        //Start Saving Image
        $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path = base_path() . '/public/images/gallery/';

        if (Input::hasFile('image_url')) {
            $image_url = Input::file('image_url');
            $image_url_name_original = Utility::getImage($image_url);
            $image_url_ext = Utility::getImageExt($image_url);
            $image_url_name = uniqid() . "." . $image_url_ext;
            $image = Utility::resizeImage($image_url, $image_url_name, $path);
        } else {
            $image_url_name = "";
        }

        if ($removeImageFlag == 1) {
            $image_url_name = "";
        }
        //End Saving Image

        $paramObj = new Gallery();
        $paramObj->name = $gallery_name;
        $paramObj->code = $code;
        $paramObj->image_url = '/images/gallery/' . $image_url_name;
        $paramObj->detail_info = $detail_info;
        $paramObj->status = $status;

        $result = $this->repo->create($paramObj);
        if ($result['laravelStatusCode'] == ReturnMessage::OK) {

            return redirect()->action('Setup\Gallery\GalleryController@index')
                ->with(FormatGenerator::message('Success', 'Gallery is created ...'));
        } else {
            return redirect()->action('Setup\Gallery\GalleryController@index')
                ->with(FormatGenerator::message('Fail', 'Gallery is not created ...'));
        }

    }

    public function edit($id)
    {
        if (Auth::check()) {
            $gallery = Gallery::find($id);
            return view('backend.gallery.gallery')->with('obj', $gallery);
        }
        return redirect('/backend_app/login');
    }

    public function update(GalleryEditRequest $request)
    {

        $validated = $request->validated();
        $id = Input::get('id');
        $gallery_name = Input::get('name');
        $code = Input::get('code');
        $detail_info = Input::get('detail_info');
        $status = Input::get('status');

        $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path = base_path() . '/public/images/gallery/';
        $remove_old_image = false;

        $paramObj = Gallery::find($id);
        $old_image = $paramObj->image_url;
        $paramObj->name = $gallery_name;
        $paramObj->code = $code;
        $paramObj->detail_info = $detail_info;
        $paramObj->status = $status;

        if (Input::hasFile('image_url')) {
            //Start Saving Image
            $image_url = Input::file('image_url');
            $image_url_name_original = Utility::getImage($image_url);
            $image_url_ext = Utility::getImageExt($image_url);
            $image_url_name = uniqid() . "." . $image_url_ext;
            $image = Utility::resizeImage($image_url, $image_url_name, $path);
            $remove_old_image = true;
            $paramObj->image_url = '/images/gallery/' . $image_url_name;
            //End Saving Image
        } else {
            if ($removeImageFlag == 1) {
                $paramObj->image_url = "";
                $remove_old_image = true;
            }
        }

        $result = $this->repo->update($paramObj);
        if ($result['laravelStatusCode'] == ReturnMessage::OK) {

            // Delete the old image
            if ($remove_old_image == true) {
                Utility::removeImage($old_image);
            }

            return redirect()->action('Setup\Gallery\GalleryController@index')
                ->with(FormatGenerator::message('Success', 'Gallery is updated ...'));
        } else {

            return redirect()->action('Setup\Gallery\GalleryController@index')
                ->with(FormatGenerator::message('Fail', 'Gallery is not updated ...'));
        }
    }

    public function destroy()
    {
        $id = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach ($new_string as $id) {
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Gallery\GalleryController@index')
            ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));
    }

    public function enable()
    {
        $id = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach ($new_string as $id) {
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Gallery\GalleryController@index')
            ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));
    }

    public function check_gallery_name()
    {
        $gallery_name = Input::get('gallery_name');
        $country_id = Input::get('country_id');
        $gallery = Gallery::where('country_id', '=', $country_id)->where('gallery_name', '=', $gallery_name)->whereNull('deleted_at')->get();
        $result = false;
        if (count($gallery) == 0) {
            $result = true;
        }

        return \Response::json($result);
    }

}
