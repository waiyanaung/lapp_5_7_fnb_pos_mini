<?php

namespace App\Http\Controllers\Frontend;

use App\Backend\Infrastructure\Forms\ProfileRequest;
use App\Core\ReturnMessage;
use App\Core\Utility;
use App\Setup\Customer\CustomerRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
//use Alert;

class UserProfileController extends Controller
{
    private $repo;
    public function __construct(CustomerRepositoryInterface $repo){
        $this->repo = $repo;
    }

    public function showMyProfile(){
        if (Auth::guard('Customer')->check()) {
            $id             = Utility::getCurrentCustomerID();
            $customer       = $this->repo->getObjByID($id);
            return view('frontend.userprofile')->with('customer', $customer);
        }
        return redirect('/');
    }

    public function updateProfile(ProfileRequest $request){
        $validated = $request->validated();
        $id                     = trim(Input::get('id'));
        $f_name                 = trim(Input::get('first_name'));
        $l_name                 = trim(Input::get('last_name'));
        $email                  = trim(Input::get('email'));
        $address                = trim(Input::get('address'));
        $gender                 = trim(Input::get('gender'));

        $password               = trim(Input::get('password'));

        $paramObj               = $this->repo->getObjByID($id);

        $paramObj->first_name   = $f_name;
        $paramObj->last_name    = $l_name;
        $paramObj->email        = $email;

        //if password is changed
        if(isset($password) && $password !== null && $password !== ""){
          $paramObj->password     = bcrypt($password);
        }
        $paramObj->address      = $address;
        $paramObj->gender       = $gender;

        $result                 = $this->repo->update($paramObj);

        if($result['laravelStatusCode'] ==  ReturnMessage::OK){
            alert()->success('Updating Profile is successful :).', 'Success')->persistent('CLOSE');
            return redirect()->action('Frontend\UserProfileController@showMyProfile');
        }
        else{
            alert()->error('Opppp!!!Something Wrong :(', 'Error')->persistent('CLOSE');
            return redirect()->action('Frontend\UserProfileController@showMyProfile');
        }

    }

    public function check_email(){

        $id         = Utility::getCurrentCustomerID();
        $email      = Input::get('email');
        $customer   = User::where('email','=',$email)
                          ->where('id','!=',$id)
                          ->whereNull('deleted_at')->get();
        $result     = false;
        if(count($customer) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }
}
