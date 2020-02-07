<?php

namespace App\Http\Controllers\Frontend;

use App\Core\Check;
use App\Frontend\Infrastructure\Forms\LoginRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;
use Session;

class LoginController extends Controller
{
    public function validSession()
    {
        $sessionObj = session('customer');
        if(isset($sessionObj)){
            return true;
        }
        return false;
    }

    public function showLogin(){
        $url = URL::previous();
        Session::put('prev_url',$url);

        if(!$this->validSession()){
            return view('frontend.login');
        }
        return redirect('/');
    }

    public function doLogin(Request $request){
        if($request->ajax()){
            $email      = trim(Input::get('email'));
            $password   = Input::get('password');

            if($email != "" && $password != ""){
                $auth = auth()->guard('Customer');

                $credentials = [
                    'email'     => $email,
                    'password'  => $password,
                    'role_id'   => 5,
                    'confirm'   => 1
                ];

                $credentials_username = [
                    'user_name'     => $email,
                    'password'  => $password,
                    'role_id'   => 5,
                    'confirm'   => 1
                ];

               
                if($auth->attempt($credentials)){
                    $id = Auth::guard('Customer')->id();
                    Check::createSessionCustomer($id);
                    $response['laravelStatusCode']  = '200';
                }
                else if($auth->attempt($credentials_username)){
                    $id = Auth::guard('Customer')->id();
                    Check::createSessionCustomer($id);
                    $response['laravelStatusCode']  = '200';
                }
                else{
                    $response['laravelStatusCode']  = '401';
                    session(['auth-error' => 'The email address or password is incorrect!']);
                }

            }else{
                $response['laravelStatusCode']  = '401';
            }
        }
        else{
            $response['laravelStatusCode']  = '202';
        }
        return \Response::json($response);

    }

    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? Lang::get('auth.failed')
            : 'The email address or password is incorrect.';
    }

    public function logout(){
        if(Session::has('customer')){
            Session::flush();
        }
        return redirect('/');
    }
}
