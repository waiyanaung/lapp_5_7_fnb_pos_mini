<?php

namespace App\Http\Controllers\FrontendLanguage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Redirect;
class FrontendLanguageController extends Controller
{
   public function changeLanguage(){
        if(Session::has('locale')){
            Session::put('locale',Input::get('locale'));
        }
        else{
            //Session::set('locale',Input::get('locale'));
            session(['locale' => Input::get('locale')]);
        }

        return Redirect::back();
    }

    public function getLanguage($lang){
        if(Session::has('locale')){
            Session::put('locale',$lang);
        }
        else{
            Session::set('locale',$lang);
        }

        return Redirect::back();
    }
}
