<?php

namespace App\Http\Controllers\Setup\FaqInformation;

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
use App\Setup\FaqInformation\FaqInformationRepositoryInterface;
use App\Backend\Infrastructure\Forms\FaqInformationEntryRequest;
use App\Backend\Infrastructure\Forms\FaqInformationEditRequest;
use App\Setup\FaqInformation\FaqInformation;

class FaqInformationController extends Controller
{
     private $repo;

     public function __construct(FaqInformationRepositoryInterface $repo)
     {
         $this->repo = $repo;
     }

    // public function edit(){
        
    //         if(Auth::check()) {
    //         // $FaqInfo     = DB::select("SELECT * FROM `faq_information_price` WHERE `type` = 'FAQ' LIMIT 1");
    //         $FaqInfo     = DB::select("SELECT * FROM `display_information` WHERE `type` = 'FAQ' LIMIT 1");

    //         $faqInformation = array();
    //         if (is_null($FaqInfo) || count($FaqInfo) == 0)
    //         {
    //             $faqInformation['description_en']   = "";
    //             $faqInformation['description_jp']   = "";
    //             return view('backend.faqinformation.faqinformation')->with('faqInformation', $faqInformation);
    //         }
    //         $faqInformation["description_en"] = $FaqInfo[0]->text_en;
    //         $faqInformation["description_jp"] = $FaqInfo[0]->text_jp;
    //         return view('backend.faqinformation.faqinformation')->with('faqInformation', $faqInformation);
    //     }
    //     return redirect('/');
    // }

    // public function update(){
    //     $currentUserID = Utility::getCurrentUserID();
    //     $date = date("Y-m-d H:i:s");

    //     $tempDescription_en    = (Input::has('description_en')) ? Input::get('description_en') : "";
    //     $tempDescription_jp    = (Input::has('description_jp')) ? Input::get('description_jp') : "";

    //     // DB::statement("DELETE FROM `faq_information_price` WHERE `type` = 'FAQ'");
    //     DB::statement("DELETE FROM `display_information` WHERE `type` = 'FAQ'");

    //     // DB::table('faq_information_price')->insert([
    //     //     ['type' => 'FAQ', 'text' => $tempDescription, 'created_by' => $currentUserID, 'updated_by' => $currentUserID, 'created_at' => $date, 'updated_at' => $date]
    //     // ]);
    //     DB::table('display_information')->insert([
    //         ['type' => 'FAQ', 'text_en' => $tempDescription_en, 'text_jp' => $tempDescription_jp, 'created_by' => $currentUserID, 'updated_by' => $currentUserID, 'created_at' => $date, 'updated_at' => $date]
    //     ]);

    //     return redirect()->action('Setup\FaqInformation\FaqInformationController@edit');
    // }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $faq_informations      = $this->repo->getObjsAll();
            return view('backend.faq_information.index')
                    ->with('objs',$faq_informations);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.faq_information.faq_information');
        }
        return redirect('/');
    }

    public function store(FaqInformationEntryRequest $request)
    {
        $validated                      = $request->validated();
        $faq_information_name           = Input::get('name');
       $detail_info                    = Input::get('detail_info');
        $status                         = Input::get('status');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/faq_information/';

        if(Input::hasFile('image_url'))
        {
            $image_url                  = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext              = Utility::getImageExt($image_url);
            $image_url_name             = uniqid() . "." . $image_url_ext;
            $image                      = Utility::resizeImage($image_url,$image_url_name,$path);
        }
        else{
            $image_url_name = "";
        }

        if($removeImageFlag == 1){
            $image_url_name = "";
        }
        //End Saving Image

        $paramObj = new FaqInformation();
        $paramObj->name         = $faq_information_name;
        $paramObj->image_url    = '/images/faq_information/' . $image_url_name;
        $paramObj->detail_info  = $detail_info;
        $paramObj->status       = $status;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\FaqInformation\FaqInformationController@index')
                ->with(FormatGenerator::message('Success', 'FaqInformation is created ...'));
        }
        else{
            return redirect()->action('Setup\FaqInformation\FaqInformationController@index')
                ->with(FormatGenerator::message('Fail', 'FaqInformation is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $faq_information        = FaqInformation::find($id);
            return view('backend.faq_information.faq_information')->with('obj', $faq_information);
        }
        return redirect('/backend_app/login');
    }
 
    public function update(FaqInformationEditRequest $request){
        
        $validated                      = $request->validated();
        $id                             = Input::get('id');
        $faq_information_name           = Input::get('name');
        $detail_info                    = Input::get('detail_info');
        $status                         = Input::get('status');
        
        $removeImageFlag                = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                           = base_path().'/public/images/faq_information/';        
        $remove_old_image               = false;

        $paramObj                       = FaqInformation::find($id);
        $old_image                      = $paramObj->image_url;
        $paramObj->name                 = $faq_information_name;
        $paramObj->detail_info          = $detail_info;
        $paramObj->status               = $status;

        if(Input::hasFile('image_url'))
        {   
            //Start Saving Image
            $image_url                  = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext              = Utility::getImageExt($image_url);
            $image_url_name             = uniqid() . "." . $image_url_ext;
            $image                      = Utility::resizeImage($image_url,$image_url_name,$path);
            $remove_old_image           = true;
            $paramObj->image_url        = '/images/faq_information/' . $image_url_name;
            //End Saving Image
        }
        else{
            if($removeImageFlag == 1){
                $paramObj->image_url    = "";
                $remove_old_image       = true;
            }
        }

        $result = $this->repo->update($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            // Delete the old image
            if($remove_old_image           == true){
                Utility::removeImage($old_image);
            }            

            return redirect()->action('Setup\FaqInformation\FaqInformationController@index')
                ->with(FormatGenerator::message('Success', 'FaqInformation is updated ...'));
        }
        else{

            return redirect()->action('Setup\FaqInformation\FaqInformationController@index')
                ->with(FormatGenerator::message('Fail', 'FaqInformation is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\FaqInformation\FaqInformationController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\FaqInformation\FaqInformationController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function check_faq_information_name(){
        $faq_information_name     = Input::get('faq_information_name');
        $country_id    = Input::get('country_id');
        $faq_information          = FaqInformation::where('country_id','=',$country_id)->where('faq_information_name','=',$faq_information_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($faq_information) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }
}
