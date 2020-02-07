<?php

namespace App\Http\Controllers\Setup\AboutUs;

use App\Core\Utility;
use App\Setup\ServicePrice\ServicePriceRepositoryInterface;
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

class AboutUsController extends Controller
{
    private $repo;

    public function __construct()
    {

    }

    public function edit(){
        if(Auth::check()) {
            // $tempAboutUs      = DB::select("SELECT * FROM `service_price` WHERE `type` = 'ABOUTUS' LIMIT 1");
            $tempAboutUs      = DB::select("SELECT * FROM `display_information` WHERE `type` = 'ABOUTUS' LIMIT 1");

            $aboutUs = array();
            if (is_null($tempAboutUs) || count($tempAboutUs) == 0)
            {
                $aboutUs['description_en']   = "";
                $aboutUs['description_jp']   = "";
                return view('backend.aboutus.aboutus')->with('aboutUs', $aboutUs);
            }
            $aboutUs["description_en"] = $tempAboutUs[0]->text_en;
            $aboutUs["description_jp"] = $tempAboutUs[0]->text_jp;

            return view('backend.aboutus.aboutus')->with('aboutUs', $aboutUs);
        }
        return redirect('/');
    }

    public function update(){
        $currentUserID = Utility::getCurrentUserID();
        $date = date("Y-m-d H:i:s");

        $tempDescription_en    = (Input::has('description_en')) ? Input::get('description_en') : "";
        $tempDescription_jp    = (Input::has('description_jp')) ? Input::get('description_jp') : "";

        // DB::statement("DELETE FROM `service_price` WHERE `type` = 'ABOUTUS'");
        DB::statement("DELETE FROM `display_information` WHERE `type` = 'ABOUTUS'");

        // DB::table('service_price')->insert([
        //     ['type' => 'ABOUTUS', 'text' => $tempDescription, 'created_by' => $currentUserID, 'updated_by' => $currentUserID, 'created_at' => $date, 'updated_at' => $date]
        // ]);

        DB::table('display_information')->insert([
            ['type' => 'ABOUTUS', 'text_en' => $tempDescription_en, 'text_jp' => $tempDescription_jp, 'created_by' => $currentUserID, 'updated_by' => $currentUserID, 'created_at' => $date, 'updated_at' => $date]
        ]);

        return redirect()->action('Setup\AboutUs\AboutUsController@edit');
    }
}
