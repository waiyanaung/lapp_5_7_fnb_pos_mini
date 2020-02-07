<?php
/**
 * Created by Visual Studio Code.
 * User: william
 * Author: Wai Yan Aung
 * Date: 1/14/2017
 * Time: 10:55 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Setup\Page\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Session;

class AboutUsController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        // $temp_data = DB::select("SELECT * FROM `service_price` WHERE `type` = 'ABOUTUS' LIMIT 1");
        $temp_data = DB::select("SELECT * FROM `display_information` WHERE `type` = 'ABOUTUS' LIMIT 1");

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

        return view('frontend.aboutus')->with('page_data',$page_data);
    }

}
