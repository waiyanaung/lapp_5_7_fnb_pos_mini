<?php

namespace App\Core;

use App\Core\Config\ConfigRepository;
use Validator;
use Auth;
use DB;
use App\Http\Requests;
use App\Session;
use App\Core\User\UserRepository;
use App\Core\SyncsTable\SyncsTable;
use Image;
use App\Log\LogCustom;
use Mail;
use App\Setup\Item\Item;
use App\Setup\CoreSettings\CoreSettings;

class Utility
{

    public static function addCreatedBy($newObj)
    {
        $sessionObj             = session('user');
        if(isset($sessionObj)){
            $userSession        = session('user');
            $loginUserId        = $userSession['id'];
            $newObj->updated_by = $loginUserId;
            $newObj->created_by = $loginUserId;
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }

    public static function addUpdatedBy($newObj)
    {
        $sessionObj = session('user');
        if(isset($sessionObj)){
            $userSession = session('user');
            $loginUserId = $userSession['id'];
            $newObj->updated_by = $loginUserId;
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }

    public static function addDeletedBy($newObj)
    {
        $sessionObj = session('user');
        if(isset($sessionObj)){
            $userSession = session('user');
            $loginUserId = $userSession['id'];
            $newObj->deleted_by = $loginUserId;
        }
        Utility::updateSyncsTable($newObj);
        return $newObj;
    }

    public static function updateSyncsTable($newObj)
    {
        $table_name         = $newObj->getTable();
        $tempSyncTable      = new SyncsTable();
        $syncTableName      = $tempSyncTable->getTable();

        $syncTableObj       = DB::table($syncTableName)
                                ->select('*')
                                ->where('table_name' , '=' , $table_name)
                                ->first();

        if(isset($syncTableObj) && count((array)$syncTableObj)>0) {
            $id                         = $syncTableObj->id;
            $version                    = $syncTableObj->version + 1;
            $syncTable                  = SyncsTable::find($id);

            $sessionObj                 = session('user');
            if (isset($sessionObj)) {
                $userSession            = session('user');
                $loginUserId            = $userSession['id'];
                $syncTable->updated_by  = $loginUserId;
            }

            $syncTable->version         = $version++;
            $syncTable->save();

        }
    }

    public static function getCurrentUserID(){
        //$id = Auth::guard('User')->user()->id;
        $user = auth()->user();
        $id = $user->id;        
        return $id;
    }

    public static function saveImage($photo,$path){
        if ( ! file_exists($path))
        {
            mkdir($path, 0777, true);
        }

        //setting photo name
        $photo_name  = $photo->getClientOriginalName();

        // moving image into image folder
        $photo->move($path, $photo_name);

        $rWidth = 1.0;
        $rHeight =  1.0;

        // getting image width and height
        $imgData = getimagesize($path . $photo_name);
        $width = $imgData[0];
        $imgWidth = $width * $rWidth;
        $height = $imgData[1];
        $imgHeight = $height * $rHeight;

        // generate unique id for the image name
        $photo_unique_name = uniqid();

        // resizing image
        $image = Image::make(sprintf($path .'/%s', $photo_name))
            ->resize($imgWidth, $imgHeight)->save();

        return $photo_name;
    }

    public static function getImage($photo){
        $photo_name = $photo->getClientOriginalName();
        return $photo_name;
    }

    public static function getImageExt($photo){
        $photo_ext = $photo->getClientOriginalExtension();

        return $photo_ext;
    }

    public static function resizeImage($photo,$photo_name,$path){

        if(! file_exists($path))
        {
            mkdir($path, 0777, true);
        }

        $photo->move($path,$photo_name);

        $rWidth     = 1.0;
        $rHeight    = 1.0;

        $imgData    = getimagesize($path . $photo_name);
        $width      = $imgData[0];
        $imgWidth   = $width * $rWidth;
        $height     = $imgData[1];
        $imgHeight  = $height * $rHeight;

        //to avoid "allowed memory size of 134217728 bytes exhausted" issue
        ini_set('memory_limit','256M');

        $image      = Image::make(sprintf($path . '/%s', $photo_name))
                      ->resize($imgWidth,$imgHeight)->save();

        return $image;

    }

    public static function resizeImageWithDefaultWidthHeight($photo,$photo_name,$path,$width,$height){

        if(! file_exists($path))
        {
            mkdir($path, 0777, true);
        }

        $photo->move($path,$photo_name);

        $rWidth     = 1.0;
        $rHeight    = 1.0;

        $imgWidth   = $width * $rWidth;
        $imgHeight  = $height * $rHeight;

        $image      = Image::make(sprintf($path . '/%s', $photo_name))
                      ->resize($imgWidth,$imgHeight)->save();

        return $image;

    }

    public static function removeImage($image_url = ""){
        try{
            unlink(public_path() . $image_url);
        }
        catch(\Exception $e){
            $currentUser = Utility::getCurrentUserID(); //get currently logged in user

            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' update the image and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }
    

    public static function getCurrentCustomerID(){
        try {
            $id = Auth::guard('Customer')->user()->id;
            return $id;
        }
        catch(\Exception $e){
            $id = 0;
            return $id;
        }
    }   

    public static function getGST(){
      $config_gst = DB::select("SELECT * FROM core_configs WHERE `code` = 'GST'");
      $gst = $config_gst[0]->value;
      return $gst;
    }

    /*
    public static function generateBookingNumber() {
        $booking_number = uniqid();
        return $booking_number;
    }
    */

    public static function getBookingIDPrefix(){
      $config_booking_id_prefix = DB::select("SELECT * FROM core_configs WHERE `code` = 'BOOKING_ID_PREFIX'");
      $booking_id_prefix = $config_booking_id_prefix[0]->value;
      return $booking_id_prefix;
    }

    public static function getBookingIDLength(){
      $config_booking_id_length = DB::select("SELECT * FROM core_configs WHERE `code` = 'BOOKING_ID_LENGTH'");
      $booking_id_length = $config_booking_id_length[0]->value;
      return $booking_id_length;
    }

    public static function generateBookingNumber($booking_id_prefix,$city_code) {
      $offset = 1; //increase 1 at a time
      // $pad_length = 5; //number of digits for auto-increment number part

      //get booking number length from config table
      $pad_length     = Utility::getBookingIDLength();

      //current date
      $year           = date("y");
      $month          = date("m");

      //prefix with current year, month and city_code (to find max)
      $full_prefix = $booking_id_prefix.' '.$year.$month.'-'.$city_code.'-';

      //start generating running number
      $max = DB::select("SELECT MAX(`booking_no`) as booking_no FROM `bookings` WHERE booking_no LIKE '$full_prefix%'");

      $newId = 1;
      if($max[0] != null && $max[0]->booking_no != null) {
          $oldId = $max[0]->booking_no;
          $numberPart = str_replace($full_prefix,"",$oldId); //get autoincrement number part by removing prefixes (year,month,city_code)
          $value = intval($numberPart); //integer value
          $newId = $value + $offset;
      }
      $runningNo = str_pad($newId, $pad_length, 0, STR_PAD_LEFT);
      return sprintf("%s%s",$full_prefix,$runningNo);
      //end generating running number
    }

    public static function getSystemAdminMail(){
        // $mail_arr   = array('testingsystem2017@gmail.com');
        $admin_roles = [1,2];
        $admin_users = DB::select("SELECT * FROM `core_users` WHERE `role_id` IN ( '" . implode( "', '" , $admin_roles) . "' ) AND `deleted_at` IS NULL");

        $mail_arr = array();

        foreach($admin_users as $admin_user){
          array_push($mail_arr,$admin_user->email);
        }
        return $mail_arr;
    }

    public static function sendMail($template,$emails,$subject,$logMessage){
        $returnedObj                        = array();
        $returnedObj['laravelStatusCode']   = ReturnMessage::OK;

        try{
            Mail::send($template, [], function($message) use($emails,$subject)
            {
                $message->to($emails)
                    ->subject($subject);
            });

            //create mail success log
            $currentUser                        = Utility::getCurrentCustomerID();
            $date                               = date("Y-m-d H:i:s");
            $message                            = '['. $date .'] '. 'info: ' . 'Mail is sent to Customer - '.$currentUser.
                ' ----- Log Message: '.$logMessage. PHP_EOL;

            LogCustom::create($date,$message);

            return $returnedObj;
        }
        catch(\Exception $e){
            //create mail error log
            $currentUser                        = Utility::getCurrentCustomerID();
            $date                               = date("Y-m-d H:i:s");
            $message                            = '['. $date .'] '. 'error: ' . 'Mail is not sent when Customer - '.$currentUser.
                ' '.$logMessage.' got error -------'.$e->getMessage(). ' ----- line ' .
                $e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;

            LogCustom::create($date,$message);
            $returnedObj['laravelStatusCode']   = ReturnMessage::SERVICE_UNAVAILABLE;

            return $returnedObj;
        }
    }

    public static function sendMailWithParameters($template,$parameters,$emails,$subject,$logMessage){
        $returnedObj                        = array();
        $returnedObj['laravelStatusCode']   = ReturnMessage::OK;

        try{
            Mail::send($template, $parameters, function($message) use($emails,$subject)
            {
                $message->to($emails)
                    ->subject($subject);
            });

            //create mail success log
            $currentUser                        = Utility::getCurrentCustomerID();
            $date                               = date("Y-m-d H:i:s");
            $message                            = '['. $date .'] '. 'info: ' . 'Mail is sent to Customer - '.$currentUser.
                ' ----- Log Message: '.$logMessage. PHP_EOL;

            LogCustom::create($date,$message);

            return $returnedObj;
        }
        catch(\Exception $e){
            //create mail error log
            $currentUser                        = Utility::getCurrentCustomerID();
            $date                               = date("Y-m-d H:i:s");
            $message                            = '['. $date .'] '. 'error: ' . 'Mail is not sent when Customer - '.$currentUser.
                ' '.$logMessage.' got error -------'.$e->getMessage(). ' ----- line ' .
                $e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;

            LogCustom::create($date,$message);
            $returnedObj['laravelStatusCode']   = ReturnMessage::SERVICE_UNAVAILABLE;

            return $returnedObj;
        }
    }

    public static function getPriceFilter(){
        $result     = DB::table('price_filter')->get();

        return $result;
    }

    public static function getPriceFilterById($id){
        $result     = DB::table('price_filter')->find($id);

        return $result;
    }

    public static function createSession($key,$value){
        Session::put($key,$value);
    }

    public static function deleteSession($key){
        Session::forget($key);
    }

    public static function sendVerificationMail($email,$name,$activation_code){
        $returnedObj                        = array();
        $returnedObj['laravelStatusCode']   = ReturnMessage::OK;

        try{

            Mail::send('frontend.mail.verify', ['activation_code'=>$activation_code,'email'=>$email], function($message) use($email,$name) {
                $message->to($email,$name)
                    ->subject('Verify your email address');
            });


            return $returnedObj;
        }
        catch(\Exception $e){
            $date                               = date("Y-m-d H:i:s");
            $message                            = '['. $date .'] '. 'error: ' . 'Verification Mail is not sent and got error -------'.
                                                  $e->getMessage(). ' ----- line ' .
                                                  $e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;

            LogCustom::create($date,$message);
            $returnedObj['laravelStatusCode']   = ReturnMessage::SERVICE_UNAVAILABLE;

            return $returnedObj;
        }
    }

    public static function delete_file_in_upload_folder($filename){
        if(PHP_OS == "WINNT"){
            $image_path = public_path().'\images\upload\\'.$filename;
        }else{
            $image_path = public_path().'/images/upload/'.$filename;
        }

            if(File::exists($image_path)){
                File::delete($image_path);
            }
    }

    public static function getCurrentUserRole(){
        $role_id = Auth::guard('User')->user()->role_id;
        return $role_id;
    }

    public static function getTermsAndCondition(){
      $temp_data = DB::select("SELECT * FROM `display_information` WHERE `type` = 'TERMS_AND_CONDITION' LIMIT 1");
      $terms_and_condition_text = "";

    //   if(isset($temp_data) && count($temp_data)>0){
    //     //check locale [language]
    //     if(Session::has('locale') && Session::get('locale') == "jp"){
    //       $terms_and_condition_text = $temp_data[0]->text_jp;
    //     }
    //     else{
    //       $terms_and_condition_text = $temp_data[0]->text_en;
    //     }
    //   }
    //   else{
    //       $terms_and_condition_text = "";
    //   }

      return $terms_and_condition_text;
    }

    public static function getCurrentUser(){
        $user = Auth::guard('User')->user();
        return $user;
    }

    public static function sendOrderMail($order_obj){
        $returnedObj                        = array();
        $returnedObj['laravelStatusCode']   = ReturnMessage::OK;
        $activation_code = "test";
        $email = '20170329test@gmail.com';
        $message = 'test';
        $name = 'test';
        

        $order_id = $order_obj['id'];
        $name = $order_obj["name"];
        $phone = $order_obj["phone"];
        $date = $order_obj["date"];
        $item_id = $order_obj["item_id"];
        $total_item_qty = $order_obj["total_item_qty"];
        $add_installation = $order_obj["add_installation"];
        $created_at = $order_obj["created_at"];

        $item = Item::find($item_id);
        $subject = 'Order [ ' . $total_item_qty . ' - ' . $item['name'] . ' ] from [ ' . $name . ' - ' . $phone . ' ]';

        $raw_emails = \App\Core\Check::adminEmails();
        $emails_array = array();
        $emails_array = explode(',', $raw_emails);
        $cc_email = ['20170329test@gmail.com','localwebtesting@gmail.com'];

        if(count($emails_array) == 0 ){
            $returnedObj['message']   = "There is no admin emails to send at database !";
            return $returnedObj;
        }
        else {
            
            if(count($emails_array) == 1 ){
                $email = $emails_array[0];
                $cc_email = [];
            }
            
            if(count($emails_array) > 1 ){
                $email = $emails_array[0];
                $arr_count = count($emails_array);
                $cc_email = array();
                for($i = 1; $i < $arr_count; $i++){
                    $cc_email[$i - 1] = $emails_array[$i];
                }
                
            }
            try{

                Mail::send('frontend.mail.send_order', ['order_obj'=>$order_obj,'item'=>$item, 'subject'=>$subject], function($message) use($email,$name,$subject,$cc_email) {
                    $message->to($email,'Admin')->cc($cc_email)
                        ->subject($subject);
                });

                return $returnedObj;
            }
            catch(\Exception $e){
                $date                               = date("Y-m-d H:i:s");
                $message                            = '['. $date .'] '. 'error: ' . 'Verification Mail is not sent and got error -------'.
                                                    $e->getMessage(). ' ----- line ' .
                                                    $e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;

                LogCustom::create($date,$message);
                $returnedObj['laravelStatusCode']   = ReturnMessage::SERVICE_UNAVAILABLE;

                return $returnedObj;
            }

        }
    }

    public static function getCoreSettingsByType($type){
        if($type == null){
            return array();
        }

        $result = array();
        $objs = DB::select("SELECT * FROM core_settings WHERE `type` = '". $type . "' ORDER BY value" );
        foreach($objs as $obj){
            $result[$obj->code] = $obj;
        }
        
        return $result;
      }

      public static function getCoreSettingByValue($type,$value){
        if($type == null || $value == null){
            $result = new CoreSettings();
            return $result;
        }

        $result = array();
        $result = CoreSettings::where('value', $value)->where('type', $type);
        return $result;
      }
}
