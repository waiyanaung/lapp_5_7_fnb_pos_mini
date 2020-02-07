<?php
/**
 * Author: william
 * Date: 2018-08-02
 * Time: 09:44 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Session;
use App\Backend\Infrastructure\Forms\ContactUsEntryRequest;
use App\Setup\ContactUs\ContactUsRepositoryInterface;
use App\Setup\ContactUs\ContactUs;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class ContactUsController extends Controller
{

    public function __construct(ContactUsRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

	public function index(Request $request)
    {
        // $temp_data = DB::select("SELECT * FROM `service_price` WHERE `type` = 'CONTACTUS' LIMIT 1");
        $temp_data = DB::select("SELECT * FROM `display_information` WHERE `type` = 'CONTACTUS' LIMIT 1");

        if(isset($temp_data) && count($temp_data)>0){
          //check locale [language]
          if(Session::has('locale') && Session::get('locale') == "jp"){
            $page_data = $temp_data[0]->text_jp;
          }
          else{
            $page_data = $temp_data[0]->text_en;
          }
        }
        else{
            $page_data = "";
        }

        return view('frontend.contactus')->with('page_data',$page_data);
	}
	
	public function store(ContactUsEntryRequest $request)
    {
		$validated = $request->validated();
        $first_name = Input::get('first_name');
        $last_name = Input::get('last_name');
		$email = Input::get('email');
		$phone = Input::get('phone');
        $detail_info = Input::get('detail_info');

        //  Checking already sent message with this phone and email or not
        $existingObj = ContactUs::where([
                            'phone' => $phone,
                            'email' => $email
                            ])->get();

                           
        if(isset($existingObj) && count($existingObj)>0){            
            alert()->warning('You already sent message !.')->persistent('OK');
            return redirect()->action('Frontend\ContactUsController@index')
                            ->with('obj',);
        }
        else{
            $paramObj = new ContactUs(); 
            $paramObj->first_name = $first_name;
            $paramObj->last_name = $last_name;
            $paramObj->email  = $email;
            $paramObj->phone = $phone;
            $paramObj->detail_info = $detail_info;

            $result = $this->repo->create($paramObj);
            if($result['laravelStatusCode'] ==  ReturnMessage::OK){
                
                $created_id = 1;
                //alert()->success('Staff successfully created with ID '.$created_id)->persistent('OK');
                // alert()->warning('You already sent message !.')->persistent('OK');
                return redirect()->action('Frontend\ContactUsController@index')
                ->with('message', 'Your message sent successfully. We will contact you back later. Thanks for your message. ');
                // ->with(FormatGenerator::message('Success', 'Message Sent Successfully ....'));
            }
            else{
                return redirect()->action('Frontend\ContactUsController@index')
                    ->with(FormatGenerator::message('Fail', 'Message can not send and fail !!!!! ....'));
            }
        }

        

    }

}
