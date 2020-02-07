<?php

namespace App\Http\Controllers\Setup\ContactUs;

use App\Core\Utility;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use Stripe\Util\Util;
use App\Backend\Infrastructure\Forms\ContactUsEntryRequest;
use App\Backend\Infrastructure\Forms\ContactUsEditRequest;
use App\Setup\ContactUs\ContactUsRepositoryInterface;
use App\Setup\ContactUs\ContactUs;

class ContactUsController extends Controller
{
    private $repo;

    public function __construct(ContactUsRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $objs      = $this->repo->getObjsAll();
            return view('backend.contactus.index')->with('objs',$objs);
        }
        return redirect('/');
    }

    public function edit($id)
    {
        if(Auth::check()) {
            $obj        = ContactUs::find($id);
            return view('backend.contactus.contactus')
                        ->with('obj', $obj);
        }
        return redirect('/backend_app/login');
    }

    public function update(ContactUsEditRequest $request){
                
        $validated      = $request->validated();
        $id             = Input::get('id');
        $remark         = Input::get('remark');
        $status         = Input::get('status');        
       
        $paramObj                       = ContactUs::find($id);
        $paramObj->remark               = $remark;
        $paramObj->status               = $status;

        $result = $this->repo->update($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\ContactUs\ContactUsController@index')
                ->with(FormatGenerator::message('Success', 'ContactUs is updated ...'));
        }
        else{

            return redirect()->action('Setup\ContactUs\ContactUsController@index')
                ->with(FormatGenerator::message('Fail', 'ContactUs is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\ContactUs\ContactUsController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\ContactUs\ContactUsController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function edit_address(){
        if(Auth::check()) {
            // $tempContactUs      = DB::select("SELECT * FROM `service_price` WHERE `type` = 'CONTACTUS' LIMIT 1");
            $tempContactUs      = DB::select("SELECT * FROM `display_information` WHERE `type` = 'CONTACTUS' LIMIT 1");
            
            $contactUs = array();
            if (is_null($tempContactUs) || count($tempContactUs) == 0)
            {
                $contactUs['description_en']   = "";
                $contactUs['description_jp']   = "";
                return view('backend.contactus.contactus_address')->with('contactUs', $contactUs);
            }
            $contactUs["description_en"] = $tempContactUs[0]->text_en;
            $contactUs["description_jp"] = $tempContactUs[0]->text_jp;

            return view('backend.contactus.contactus_address')->with('contactUs', $contactUs);
        }
        return redirect('/');
    }

    public function update_address(){
        $currentUserID = Utility::getCurrentUserID();
        $date = date("Y-m-d H:i:s");

        $tempDescription_en    = (Input::has('description_en')) ? Input::get('description_en') : "";
        $tempDescription_jp    = (Input::has('description_jp')) ? Input::get('description_jp') : "";
        
        // DB::statement("DELETE FROM `service_price` WHERE `type` = 'CONTACTUS'");
        DB::statement("DELETE FROM `display_information` WHERE `type` = 'CONTACTUS'");

        // DB::table('service_price')->insert([
        //     ['type' => 'CONTACTUS', 'text' => $tempDescription, 'created_by' => $currentUserID, 'updated_by' => $currentUserID, 'created_at' => $date, 'updated_at' => $date]
        // ]);

        DB::table('display_information')->insert([
            ['type' => 'CONTACTUS', 'text_en' => $tempDescription_en, 'text_jp' => $tempDescription_jp, 'created_by' => $currentUserID, 'updated_by' => $currentUserID, 'created_at' => $date, 'updated_at' => $date]
        ]);

        return redirect()->action('Setup\ContactUs\ContactUsController@edit_address');
    }
}
