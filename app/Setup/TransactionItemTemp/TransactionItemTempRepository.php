<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/21/2016
 * Time: 3:51 PM
 */
namespace App\Setup\TransactionItemTemp;

use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Setup\TransactionItemTemp\TransactionItemTemp;
use App\Core\Utility;
use App\Core\ReturnMessage;
class TransactionItemTempRepository implements TransactionItemTempRepositoryInterface
{
    public function getObjs()
    {
        $rawObjs = TransactionItemTemp::whereNull('deleted_at')->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }

    public function getObjsByCategoryId($category_id)
    {
        $rawObjs = TransactionItemTemp::where('category_id',$category_id)->whereNull('deleted_at')->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }
    

    public function getObjsByBrandId($brand_id)
    {
        $rawObjs = TransactionItemTemp::where('brand_id',$brand_id)->whereNull('deleted_at')->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }

    public function getObjsByFilters($brand_id,$item_horse_power_id,$item_cooling_capacity_id)
    {
        $query = TransactionItemTemp::query();

        if ($brand_id != 0) {
           $query->where('brand_id',$brand_id);
        }

        if ($item_horse_power_id != 0) {
            $query->where('item_horse_power_id',$item_horse_power_id);
        }

        if ($item_cooling_capacity_id != 0) {
            $query->where('item_cooling_capacity_id',$item_cooling_capacity_id);
        }
        $query->whereNull('deleted_at');
        $rawObjs = $query->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }


    public function getObjsAll()
    {
        $rawObjs = TransactionItemTemp::all();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }

    public function getArrays()
    {
        $tbName = (new TransactionItemTemp())->getTable();
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
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created Item_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a TransactionItemTemp and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
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
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated Item_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated Item_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = TransactionItemTemp::find($id);
            $tempObj = Utility::addDeletedBy($tempObj);
            $tempObj->deleted_at = date('Y-m-d H:m:i');
            $tempObj->status = 0;
            $tempObj->save();

            //delete info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted Item_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  Item_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function activate($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = TransactionItemTemp::find($id);
            $tempObj = Utility::addUpdatedBy($tempObj);
            $tempObj->deleted_at = NULL;
            $tempObj->deleted_by = NULL;
            $tempObj->status = 1;
            $tempObj->save();

            //activate info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' activated item_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //activate error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleactivatedted  item_id = ' . $id . ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){
        $role = TransactionItemTemp::find($id);
        return $role;
    }

    public function getItemByCountryId($country_id){
        // $result = DB::table('Items')->where('country_id', $country_id)->whereNull('deleted_at')->get();
        $result=TransactionItemTemp::where('country_id', $country_id)->whereNull('deleted_at')->get();
        return $result;
    }

    public function checkToDelete($id){
        $result = DB::select("SELECT * FROM townships WHERE Item_id = $id AND deleted_at IS NULL");
        return $result;
    }

  
}