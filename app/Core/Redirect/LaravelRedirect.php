<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/30/2016
 * Time: 2:42 PM
 */
namespace App\Core\Redirect;
use App\Core\Check;
use Redirect;
class LaravelRedirect implements LaravelRedirectInterface {

    public function firstRedirect() {
        if(Check::validSession()){
            return Redirect::intended("/cl/dashboard");
        }
        else{
            return Redirect::intended("/");
        }
    }
    
    public function firstRedirectPath() {
        if(Check::validSession()) {
            return "cl/dashboard";
        }
        else{
            return "/";
        }
    }


    public function afterAuthedRedirect() {
        if(Check::validSession()) {
            return Redirect::intended("cl/dashboard");
        }
        else{
            return Redirect::intended("/");
        }
    }

    public function afterAuthedRedirectPath() {
        if(Check::validSession()) {
            return "cl/dashboard";
        }
        else{
            return "/";
        }
    }

}