<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setup\FaqInformation\FaqInformationRepositoryInterface;
use App\Setup\FaqInformation\FaqInformation;

class FaqInformationController extends Controller
{
    public function __construct(FaqInformationRepositoryInterface $repo)
	{
		$this->repo = $repo;
	}

    public function index(Request $request)
    {
        // $temp_data = DB::select("SELECT * FROM `service_price` WHERE `type` = 'FAQ' LIMIT 1");
        // $temp_data = DB::select("SELECT * FROM `display_information` WHERE `type` = 'FAQ' LIMIT 1");

        // if(isset($temp_data) && count($temp_data)>0){
        //   //check locale [language]
        //   if(Session::has('locale') && Session::get('locale') == "jp"){
        //     $page_data = $temp_data[0]->text_jp;
        //   }
        //   else{
        //     $page_data = $temp_data[0]->text_en;
        //   }
        // }
        // else{
        //     $page_data = "";
        // }

        // return view('frontend.faqinformation')->with('page_data',$page_data);

        $objs = $this->repo->getObjs();

        return view('frontend.faqinformation')
            ->with('objs', $objs);
    }
}
