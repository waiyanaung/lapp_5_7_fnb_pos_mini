<?php

namespace App\Http\Controllers\Frontend;

use App\Core\Check;
use App\Core\ReturnMessage;
use App\Setup\Customer\CustomerRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Core\Nrc\Nrc;
use App\Core\Nrc\NrcRepository;
use Image;
use App\Core\Utility;
use App\Http\Requests\CustomerEntryRequest;
use Illuminate\Support\Facades\Validator;
use App\Setup\Township\Township;

class UserRegistrationController extends Controller
{
    private $repo;
    public function __construct(CustomerRepositoryInterface $repo){
        $this->repo = $repo;
    }

    public function create(){
        
        if(Check::validSessionCustomer()){
            return redirect('/');
        }
        else{
                $townships = Township::query()
                        ->where('city_id', '=', 14) 
                        ->get();                    
            return view('frontend.registration')->with('townships',$townships);
        }
        return redirect('/');
        
    }

    public function store(Request $request){
        $response                           = array();

        // Go to App\Http\Requests]CustomerEntryRequest;
        // $validated = $request->validated();

        $all_input = Input::all();
        $user_type = 5;;

        $rules = [
            'user_name'     => 'required|string|unique:core_users',
            'first_name'  => 'required|string',             
            'phone'        => 'required|string|unique:core_users',
            'email'         => "required|email|unique:core_users",
            'password'      => 'required|min:8',
            'confirm_password'   => 'required|same:password',
            'township_id'   => 'required',
            'address'   => 'required',
            //  'role_id'       => 'required'            
            // 'nrc_number'  => 'required|numeric',
            // 'display_image'=> 'required|mimes:jpeg,jpg,png,gif',
            // 'display_image_front'=> 'required|mimes:jpeg,jpg,png,gif',
            // 'display_image_back'=> 'required|mimes:jpeg,jpg,png,gif',            
         ];
       

        $messages = [
        'user_name.required'    => '* User Login Name is required !',
            'user_name.unique'    => '* This Login User Name has already been taken. Please choose another one !',
            'first_name.required' => '* User First Name is required !',
            'phone.required'    => '* Phone is required !',
            'phone.unique'    => '* This Phone Number has already been taken. Please choose another one !',
            'email.required'        => '* Email is required !',
            'password.required'     => '* Password is required !',
            'confirm_password.required'  => '* Confirm Password is required !',
            'confirm_password.same'      => '* Password and Confirm Password must match !',
            'township_id.required'      => '* Township is required !',
            'address.required'      => '* Address is required !',
            //  'role_id.required'      => '* Staff Role is required !'
        ];

        $validator = Validator::make($all_input, $rules, $messages);
        
        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_name                      = trim(Input::get('user_name'));
        $f_name                         = trim(Input::get('first_name'));
        $l_name                         = trim(Input::get('last_name'));
        $display_name                   = $f_name.' '.$l_name;
        $email                          = trim(Input::get('email'));
        $phone                          = trim(Input::get('phone'));
        $dob                            = trim(Input::get('dob'));
        $pwd_txt                        = base64_encode(trim(Input::get('password')));
        $pwd                            = bcrypt(trim(Input::get('password')));
        $activation_code                = str_random(20);
        $activation_str                 = $activation_code.'_'.$pwd_txt;
        $township_id                    = trim(Input::get('township_id'));
        $address                         = trim(Input::get('address'));       

        $gender                          = Input::get('gender'); //get gender

        DB::beginTransaction();
        $paramObj                       = new User();
        $paramObj->user_name            = $user_name;
        $paramObj->first_name           = $f_name;
        $paramObj->first_name           = $f_name;
        $paramObj->last_name            = $l_name;
        $paramObj->display_name         = $display_name;
        $paramObj->phone                = $phone;
        $paramObj->dob                  = $dob;
        $paramObj->email                = $email;
        $paramObj->password             = $pwd;        
        $paramObj->gender               = $gender;
        $paramObj->activation_code      = $activation_code;
        $paramObj->role_id              = $user_type;
        $paramObj->township_id          = $township_id;
        $paramObj->address              = $address;
        $paramObj->confirm              = 1;
        $res                            = $this->repo->create($paramObj);
        
        try{                
            if($res['laravelStatusCode'] == ReturnMessage::OK){
                //Confirmation Mail Send
                //$sendMailResult             = Utility::sendVerificationMail($email,$name,$activation_str);
                // if($sendMailResult['laravelStatusCode'] == ReturnMessage::OK){
                //     $response['laravelStatusCode']  = '200';
                //     DB::commit();
                // }
                // else{
                //     $response['laravelStatusCode']  = '201';
                //     DB::rollback();
                // }
                
                DB::commit();
                alert()->success('New user registeration is successful.', 'Success')->persistent('CLOSE');                
                return redirect('/register'); 
                
            }
            else{                
                DB::rollback();
                alert()->error('New user registeration is fail!', 'Fail')->persistent('CLOSE');
                return redirect('/register'); 
            }

        }
        catch(\Exception $e){               
            alert()->error('New user registeration is fail with unexpected error. Please connect to the web admin. sorry for error !', 'Fail')->persistent('CLOSE');
            return redirect('/register'); 
        }

        // return \Response::json($response);
        alert()->error('New user registeration is fail!', 'Fail')->persistent('CLOSE');
        return redirect('/register'); 
    }


    public function verify($confirmation_code)
    {
//        $last_pos           = strripos($confirmation_code,'_')+1;
        $password           = base64_decode(substr($confirmation_code,21));
        $activation_code    = substr($confirmation_code,0,20);

        $customer           = User::where('activation_code',$activation_code)->whereNull('deleted_at')->first();
        $customer->confirm  = 1;
        $customer->save();

        $email              = $customer->email;

        $auth = auth()->guard('Customer');
        $credentials = [
            'email'     => $email,
            'password'  => $password
        ];
        if($auth->attempt($credentials)){
            $auth_id = auth()->guard('Customer')->id();
            Check::createSessionCustomer($auth_id);
            return redirect('bookingList');
        }
        return redirect('/');

    }

    public function check_email(){
        $email      = Input::get('email');
        $customer   = User::where('email','=',$email)->whereNull('deleted_at')->get();
        $result     = false;
        if(count($customer) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }
}
