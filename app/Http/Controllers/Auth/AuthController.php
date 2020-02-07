<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Core\Check;
use App\Backend\Infrastructure\Forms\LoginFormRequest;
use Auth;
use App\User;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
	/**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
	protected $redirectTo = '/backend_app';
	protected $guard='User';
	protected $redirectAfterLogout='backend_app/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('guest', ['except' => 'doLogout']);
    	$this->validSession = Check::validSession();
    }

    public function showLogin()
    {
    	if(!$this->validSession) {

    		return view('auth.login');
    	}
    	$aplusRedirect = new LaravelRedirect();
    	return $aplusRedirect->firstRedirect();
    }

    public function doLoginWithUserNameOnly(LoginFormRequest $request){
    	$validatedData = $request->validated();
    	$validation = Auth::attempt([
            'user_name'=>$request->user_name,
            'password'=>$request->password,
        ]);

    	if(!$validation){
    		return redirect()->back()->withErrors($this->getFailedLoginMessage());
    	}
    	else{

            $id = auth()->id();

            // Extra Authentication for user status ( Active / Inactive )
            $user = auth()->user();          
            if ($user->status !== 1) {
                Auth::logout();
                
                return redirect()->back()->withErrors('Deactivated user ! Please check with the system administartor !!!! ');
            }

    		Check::createSession($id);
    		return redirect('/backend_app/userAuth');
    	}
    }

    public function doLogin(LoginFormRequest $request){
        
    	$validatedData = $request->validated();
        $user_name = $request->user_name;
        $email = $request->user_name;
        $password = $request->password;
        $validated = false;

        // Checking with login user_name for login
        if (Auth::attempt(['user_name' => $user_name, 'password' => $password])) {
            $validated = true;
        }
        // Checking with login email for login
        else if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $validated = true;
        }
        else{
            $validated = false;
        }

        if($validated == true){
            $id = auth()->id();

            // Extra Authentication for user status ( Active / Inactive )
            $user = auth()->user();          
            if ($user->status !== 1) {
                Auth::logout();                
                return redirect()->back()->withErrors('Deactivated user ! Please check with the system administartor !!!! ');
            }
            else{                
                Check::createSession($id);
                return redirect('/backend_app/userAuth');
            }
        }
        else{
            return redirect()->back()->withErrors($this->getFailedLoginMessage());
        }
    }

    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? Lang::get('auth.failed')
            : 'These credentials do not match our records.';
    }

    public function doLogout() //before logout, flush the session data
    {
        session()->flush();
        return redirect('/backend_app');
    }

}
