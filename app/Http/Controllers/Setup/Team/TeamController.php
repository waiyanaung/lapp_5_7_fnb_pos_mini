<?php

namespace App\Http\Controllers\Setup\Team;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\TeamEntryRequest;
use App\Backend\Infrastructure\Forms\TeamEditRequest;
use App\Setup\Team\TeamRepositoryInterface;
use App\Setup\Team\Team;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use image;

class TeamController extends Controller
{
    private $repo;

    public function __construct(TeamRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $teams      = $this->repo->getObjsAll();
            return view('backend.team.index')->with('teams',$teams);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.team.team');
        }
        return redirect('/');
    }

    public function store(TeamEntryRequest $request)
    {
        $validated                      = $request->validated();
        $team_name                      = Input::get('name');
        $code                           = Input::get('code');
        $image_url_name                 = "";
        $detail_info                    = Input::get('detail_info');
        $email                          = Input::get('email');
        $phone_no                       = Input::get('phone_no');
        $status                         = Input::get('status');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/team/';

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

        $paramObj = new Team();
        $paramObj->name         = $team_name;
        $paramObj->code         = $code;
        $paramObj->image_url    = '/images/team/' . $image_url_name;
        $paramObj->detail_info  = $detail_info;
        $paramObj->email        = $email;
        $paramObj->phone_no     = $phone_no;
        $paramObj->status       = $status;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Team\TeamController@index')
                ->with(FormatGenerator::message('Success', 'Team is created ...'));
        }
        else{
            return redirect()->action('Setup\Team\TeamController@index')
                ->with(FormatGenerator::message('Fail', 'Team is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $team        = Team::find($id);
            return view('backend.team.team')->with('obj', $team);
        }
        return redirect('/backend_app/login');
    }

    public function update(TeamEditRequest $request){
        
        $validated                      = $request->validated();
        $id                             = Input::get('id');
        $team_name                      = Input::get('name');
        $code                           = Input::get('code');
        $detail_info                    = Input::get('detail_info');
        $email                          = Input::get('email');
        $phone_no                       = Input::get('phone_no');
        $status                         = Input::get('status');
        
        $removeImageFlag                = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                           = base_path().'/public/images/team/';        
        $remove_old_image               = false;

        $paramObj                       = Team::find($id);
        $old_image                      = $paramObj->image_url;
        $paramObj->name                 = $team_name;
        $paramObj->code                 = $code;
        $paramObj->detail_info          = $detail_info;
        $paramObj->email                = $email;
        $paramObj->phone_no             = $phone_no;
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
            $paramObj->image_url        = '/images/team/' . $image_url_name;
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

            return redirect()->action('Setup\Team\TeamController@index')
                ->with(FormatGenerator::message('Success', 'Team is updated ...'));
        }
        else{

            return redirect()->action('Setup\Team\TeamController@index')
                ->with(FormatGenerator::message('Fail', 'Team is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Team\TeamController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Team\TeamController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function check_team_name(){
        $team_name     = Input::get('team_name');
        $country_id    = Input::get('country_id');
        $team          = Team::where('country_id','=',$country_id)->where('team_name','=',$team_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($team) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
