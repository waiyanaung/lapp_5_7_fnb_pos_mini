<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/21/2016
 * Time: 3:51 PMgetObjByID
 */
namespace App\Setup\FaqInformation;

use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Setup\FaqInformation\FaqInformation;
use App\Core\Utility;
use App\Core\ReturnMessage;
class FaqInformationRepository implements FaqInformationRepositoryInterface
{
    public function getObjs()
    {
        $objs = FaqInformation::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getObjsAll()
    {
        $objs = FaqInformation::all();
        return $objs;
    }

    public function getArrays()
    {
        $tbName = (new FaqInformation())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL");
        return $arr;
    }

    public function create($paramObj)
    {
        $returnedObj = array();
        $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            //create info log
            $date = $tempObj->created_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created faq_information_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a faq_information and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($paramObj)
    {
        $returnedObj = array();
        $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {
            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            //update info log
            $date = $tempObj->updated_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated faq_information_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated faq_information_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = FaqInformation::find($id);
            $tempObj = Utility::addDeletedBy($tempObj);
            $tempObj->deleted_at = date('Y-m-d H:m:i');
            $tempObj->status = 0;
            $tempObj->save();

            //delete info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted faq_information_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  faq_information_id = ' . $id . ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function activate($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = FaqInformation::find($id);
            $tempObj = Utility::addUpdatedBy($tempObj);
            $tempObj->deleted_at = NULL;
            $tempObj->deleted_by = NULL;
            $tempObj->status = 1;
            $tempObj->save();

            //activate info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' activated faq_information_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //activate error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleactivatedted  faq_information_id = ' . $id . ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){
        $obj = FaqInformation::find($id);
        return $obj;
    }

    public function getFaqInformationByCountryId($country_id){
        // $result = DB::table('faq_informations')->where('country_id', $country_id)->whereNull('deleted_at')->get();
        $result=FaqInformation::where('country_id', $country_id)->whereNull('deleted_at')->get();
        return $result;
    }

    public function checkToDelete($id){
        $result = DB::select("SELECT * FROM townships WHERE faq_information_id = $id AND deleted_at IS NULL");
        return $result;
    }

  
}