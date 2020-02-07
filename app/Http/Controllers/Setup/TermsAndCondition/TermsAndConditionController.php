<?php

namespace App\Http\Controllers\Setup\TermsAndCondition;

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

class TermsAndConditionController extends Controller
{
    private $repo;

    public function __construct()
    {

    }

    public function edit(){
        if(Auth::check()) {
            // $tempTermsAndConditionInfo      = DB::select("SELECT * FROM `service_price` WHERE `type` = 'TERMS_AND_CONDITION' LIMIT 1");

            $tempTermsAndConditionInfo      = DB::select("SELECT * FROM `display_information` WHERE `type` = 'TERMS_AND_CONDITION' LIMIT 1");

            $termsAndConditionInformation = array();
            if (is_null($tempTermsAndConditionInfo) || count($tempTermsAndConditionInfo) == 0)
            {
                $termsAndConditionInformation['description_en']   = "";
                $termsAndConditionInformation['description_jp']   = "";
                return view('backend.termsandcondition.termsandcondition')->with('termsAndConditionInformation', $termsAndConditionInformation);
            }
            $termsAndConditionInformation["description_en"] = $tempTermsAndConditionInfo[0]->text_en;
            $termsAndConditionInformation["description_jp"] = $tempTermsAndConditionInfo[0]->text_jp;
            return view('backend.termsandcondition.termsandcondition')->with('termsAndConditionInformation', $termsAndConditionInformation);
        }
        return redirect('/');
    }

    public function update(){
        
        $currentUserID = Utility::getCurrentUserID();
        $date = date("Y-m-d H:i:s");

        $tempDescription_en    = (Input::has('description_en')) ? Input::get('description_en') : "";
        $tempDescription_jp    = (Input::has('description_jp')) ? Input::get('description_jp') : "";

        // DB::statement("DELETE FROM `service_price` WHERE `type` = 'TERMS_AND_CONDITION'");
        DB::statement("DELETE FROM `display_information` WHERE `type` = 'TERMS_AND_CONDITION'");

        // DB::table('service_price')->insert([
        //     ['type' => 'TERMS_AND_CONDITION', 'text' => $tempDescription, 'created_by' => $currentUserID, 'updated_by' => $currentUserID, 'created_at' => $date, 'updated_at' => $date]
        // ]);
        DB::table('display_information')->insert([
            ['type' => 'TERMS_AND_CONDITION', 'text_en' => $tempDescription_en,'text_jp' => $tempDescription_jp, 'created_by' => $currentUserID, 'updated_by' => $currentUserID, 'created_at' => $date, 'updated_at' => $date]
        ]);

        return redirect()->action('Setup\TermsAndCondition\TermsAndConditionController@edit');
    }
}
