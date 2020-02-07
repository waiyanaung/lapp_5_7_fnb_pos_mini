<?php

namespace App\Http\Controllers\Setup\Township;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use App\Setup\City\CityRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\TownshipEntryRequest;
use App\Backend\Infrastructure\Forms\TownshipEditRequest;
use App\Setup\Township\TownshipRepositoryInterface;
use App\Setup\Township\Township;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class TownshipController extends Controller
{
    private $repo;

    public function __construct(TownshipRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $townships      = $this->repo->getObjsAll();
            return view('backend.township.index')
                            ->with('townships',$townships);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            $countryRepo = new CountryRepository();
            $countries = $countryRepo->getObjsAll();

            $cityRepo   = new CityRepository();
            $cities     = $cityRepo->getObjsAll();
            return view('backend.township.township')
                            ->with('cities', $cities)
                            ->with('countries',$countries);
        }
        return redirect('/');
    }

    public function store(TownshipEntryRequest $request)
    {
        $validated      = $request->validated();
        $township_name      = Input::get('name');
        $city_id      = Input::get('city_id');
        $code           = Input::get('code');
        $status         = Input::get('status');
        $description    = Input::get('description');
        $remark         = Input::get('remark');
        $detail_info    = Input::get('detail_info');

        //Start Saving Image
        $removeImageFlag    = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path               = base_path().'/public/images/township/';

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

        $paramObj                   = new Township();
        $paramObj->name             = $township_name;
        $paramObj->city_id       = $city_id;
        $paramObj->code             = $code;
        $paramObj->status           = $status;
        $paramObj->description      = $description;
        $paramObj->remark           = $remark;
        $paramObj->detail_info      = $detail_info;
        $paramObj->image_url        = '/images/township/' . $image_url_name;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Township\TownshipController@index')
                ->with(FormatGenerator::message('Success', 'Township is created ...'));
        }
        else{
            return redirect()->action('Setup\Township\TownshipController@index')
                ->with(FormatGenerator::message('Fail', 'Township is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $township        = Township::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjsAll();

            $cityRepo   = new CityRepository();
            $cities     = $cityRepo->getObjsAll();

            return view('backend.township.township')
                                        ->with('obj', $township)
                                        ->with('cities', $cities)
                                        ->with('countries', $countries);
        }
        return redirect('/backend_app/login');
    }

    public function update(TownshipEditRequest $request){

        $validated = $request->validated();
        $id                         = Input::get('id');
        $township_name                  = Input::get('name');
        $city_id                 = Input::get('city_id');
        $code                       = Input::get('code');
        $status                     = Input::get('status');
        $description                = Input::get('description');
        $remark                     = Input::get('remark');
        $detail_info                = Input::get('detail_info');        
        
        $removeImageFlag            = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                       = base_path().'/public/images/township/';        
        $remove_old_image               = false;

        $paramObj                   = Township::find($id);
        $old_image                  = $paramObj->image_url;
        $paramObj->name             = $township_name;
        $paramObj->city_id       = $city_id;
        $paramObj->code             = $code;
        $paramObj->status           = $status;
        $paramObj->description      = $description;
        $paramObj->remark           = $remark;
        $paramObj->detail_info      = $detail_info;

        if(Input::hasFile('image_url'))
        {   
            //Start Saving Image
            $image_url                  = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext              = Utility::getImageExt($image_url);
            $image_url_name             = uniqid() . "." . $image_url_ext;
            $image                      = Utility::resizeImage($image_url,$image_url_name,$path);
            $remove_old_image           = true;
            $paramObj->image_url        = '/images/township/' . $image_url_name;
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

            return redirect()->action('Setup\Township\TownshipController@index')
                ->with(FormatGenerator::message('Success', 'Township is updated ...'));
        }
        else{

            return redirect()->action('Setup\Township\TownshipController@index')
                ->with(FormatGenerator::message('Fail', 'Township is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Township\TownshipController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Township\TownshipController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function check_township_name(){
        $township_name     = Input::get('township_name');
        $city_id    = Input::get('city_id');
        $township          = Township::where('city_id','=',$city_id)->where('township_name','=',$township_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($township) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
