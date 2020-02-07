<?php

namespace App\Http\Controllers\Setup\Slider;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\SliderEntryRequest;
use App\Backend\Infrastructure\Forms\SliderEditRequest;
use App\Setup\Slider\SliderRepositoryInterface;
use App\Setup\Slider\Slider;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use image;

class SliderController extends Controller
{
    private $repo;

    public function __construct(SliderRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $sliders      = $this->repo->getObjsAll();
            return view('backend.slider.index')->with('sliders',$sliders);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.slider.slider');
        }
        return redirect('/');
    }

    public function store(SliderEntryRequest $request)
    {
        $validated                      = $request->validated();
        $slider_name                      = Input::get('name');
        $code                           = Input::get('code');
        $image_url_name                 = "";
        $detail_info                    = Input::get('detail_info');
        $status                         = Input::get('status');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/slider/';

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

        $paramObj = new Slider();
        $paramObj->name         = $slider_name;
        $paramObj->code         = $code;
        $paramObj->image_url    = '/images/slider/' . $image_url_name;
        $paramObj->detail_info  = $detail_info;
        $paramObj->status       = $status;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Slider\SliderController@index')
                ->with(FormatGenerator::message('Success', 'Slider is created ...'));
        }
        else{
            return redirect()->action('Setup\Slider\SliderController@index')
                ->with(FormatGenerator::message('Fail', 'Slider is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $slider        = Slider::find($id);
            return view('backend.slider.slider')->with('obj', $slider);
        }
        return redirect('/backend_app/login');
    }

    public function update(SliderEditRequest $request){
        
        $validated                      = $request->validated();
        $id                             = Input::get('id');
        $slider_name                      = Input::get('name');
        $code                           = Input::get('code');
        $detail_info                    = Input::get('detail_info');
        $status                         = Input::get('status');
        
        $removeImageFlag                = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                           = base_path().'/public/images/slider/';        
        $remove_old_image               = false;

        $paramObj                       = Slider::find($id);
        $old_image                      = $paramObj->image_url;
        $paramObj->name                 = $slider_name;
        $paramObj->code                 = $code;
        $paramObj->detail_info          = $detail_info;
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
            $paramObj->image_url        = '/images/slider/' . $image_url_name;
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

            return redirect()->action('Setup\Slider\SliderController@index')
                ->with(FormatGenerator::message('Success', 'Slider is updated ...'));
        }
        else{

            return redirect()->action('Setup\Slider\SliderController@index')
                ->with(FormatGenerator::message('Fail', 'Slider is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Slider\SliderController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Slider\SliderController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function check_slider_name(){
        $slider_name     = Input::get('slider_name');
        $country_id    = Input::get('country_id');
        $slider          = Slider::where('country_id','=',$country_id)->where('slider_name','=',$slider_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($slider) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
