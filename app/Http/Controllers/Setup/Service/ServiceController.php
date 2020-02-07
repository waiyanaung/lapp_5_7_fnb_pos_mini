<?php

namespace App\Http\Controllers\Setup\Service;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ServiceEntryRequest;
use App\Backend\Infrastructure\Forms\ServiceEditRequest;
use App\Setup\Service\ServiceRepositoryInterface;
use App\Setup\Service\Service;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use image;

class ServiceController extends Controller
{
    private $repo;

    public function __construct(ServiceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $services      = $this->repo->getObjsAll();
            return view('backend.service.index')->with('services',$services);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.service.service');
        }
        return redirect('/');
    }

    public function store(ServiceEntryRequest $request)
    {
        $validated                      = $request->validated();
        $service_name                      = Input::get('name');
        $code                           = Input::get('code');
        $image_url_name                 = "";
        $detail_info                    = Input::get('detail_info');
        $price                          = Input::get('price');
        $description                    = Input::get('description');
        $status                         = Input::get('status');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/service/';

        if(Input::hasFile('image_url'))
        {
            $image_url                  = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext              = Utility::getImageExt($image_url);
            $image_url_name             = uniqid() . "." . $image_url_ext;
            $image                      = Utility::resizeImage($image_url,$image_url_name,$path);
        }
        else{
            $image_url_name = "";
        }

        if($removeImageFlag == 1){
            $image_url_name = "";
        }
        //End Saving Image

        $paramObj = new Service();
        $paramObj->name         = $service_name;
        $paramObj->code         = $code;
        $paramObj->image_url    = '/images/service/' . $image_url_name;
        $paramObj->detail_info  = $detail_info;
        $paramObj->price        = $price;
        $paramObj->description      = $description;
        $paramObj->status       = $status;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Service\ServiceController@index')
                ->with(FormatGenerator::message('Success', 'Service is created ...'));
        }
        else{
            return redirect()->action('Setup\Service\ServiceController@index')
                ->with(FormatGenerator::message('Fail', 'Service is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $service        = Service::find($id);
            return view('backend.service.service')->with('obj', $service);
        }
        return redirect('/backend_app/login');
    }
 
    public function update(ServiceEditRequest $request){
        
        $validated                      = $request->validated();
        $id                             = Input::get('id');
        $service_name                    = Input::get('name');
        $code                           = Input::get('code');
        $detail_info                    = Input::get('detail_info');
        $price                          = Input::get('price');
        $description                    = Input::get('description');
        $status                         = Input::get('status');
        
        $removeImageFlag                = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                           = base_path().'/public/images/service/';        
        $remove_old_image               = false;

        $paramObj                       = Service::find($id);
        $old_image                      = $paramObj->image_url;
        $paramObj->name                 = $service_name;
        $paramObj->code                 = $code;
        $paramObj->detail_info          = $detail_info;
        $paramObj->price                = $price;
        $paramObj->description          = $description;
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
            $paramObj->image_url        = '/images/service/' . $image_url_name;
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

            return redirect()->action('Setup\Service\ServiceController@index')
                ->with(FormatGenerator::message('Success', 'Service is updated ...'));
        }
        else{

            return redirect()->action('Setup\Service\ServiceController@index')
                ->with(FormatGenerator::message('Fail', 'Service is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Service\ServiceController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Service\ServiceController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function check_service_name(){
        $service_name     = Input::get('service_name');
        $country_id    = Input::get('country_id');
        $service          = Service::where('country_id','=',$country_id)->where('service_name','=',$service_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($service) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
