<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/21/2016
 * Time: 3:51 PM
 */
namespace App\Setup\Item;

use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Setup\Item\Item;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Setup\Brand\Brand;
use App\Setup\Category\Category;
class ItemRepository implements ItemRepositoryInterface
{
    public function getObjs()
    {
        $rawObjs = Item::whereNull('deleted_at')->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }

    public function getObjsByCategoryId($category_id)
    {
        $rawObjs = Item::where('category_id',$category_id)->whereNull('deleted_at')->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }
    

    public function getObjsByBrandId($brand_id)
    {
        $rawObjs = Item::where('brand_id',$brand_id)->whereNull('deleted_at')->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }

    public function getObjsByFilters($brand_id,$item_horse_power_id,$item_cooling_capacity_id)
    {
        $query = Item::query();

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
        $rawObjs = Item::all();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }

    public function getObjsAllByLastItemFilter()
    {
        $rawObjs = Item::all();
        $rawObjs = Item::orderByDesc('id')->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }

    public function getArrays()
    {
        $tbName = (new Item())->getTable();
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
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a Item and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
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
            $tempObj = Item::find($id);
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
            $tempObj = Item::find($id);
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
        $role = Item::find($id);
        return $role;
    }

    public function getItemByCountryId($country_id){
        // $result = DB::table('Items')->where('country_id', $country_id)->whereNull('deleted_at')->get();
        $result=Item::where('country_id', $country_id)->whereNull('deleted_at')->get();
        return $result;
    }

    public function checkToDelete($id){
        $result = DB::select("SELECT * FROM townships WHERE Item_id = $id AND deleted_at IS NULL");
        return $result;
    }

    public function getItemByCategoryId($category_id){
        $result = Item::where('category_id', $category_id)->whereNull('deleted_at')->get();
        return $result;
    }

    public function getItemByBrandId($brand_id){
        $result = Item::where('brand_id', $brand_id)->whereNull('deleted_at')->get();
        return $result;
    }

    
    public function getItemById($id){
        $result_raw = Item::where('id', $id)->whereNull('deleted_at')->first();
        $result = $result_raw->toArray();
        return $result;
    }

    public function getBrandsByCategoryId($category_id){

        $item_obj = new Item();
        $tb_item = $item_obj->getTable();

        $brand_obj = new Brand();
        $tb_brand = $brand_obj->getTable();

        $category_obj = new Category();
        $tb_category = $category_obj->getTable();

        $result = DB::table($tb_item)
            ->join($tb_brand, $tb_item.'.brand_id', '=', $tb_brand.'.id')
            ->select($tb_brand.'.*')->distinct()
            ->where($tb_item.'.category_id','=',$category_id)
            ->get();

        // $result = Item::where('category_id', $category_id)->whereNull('deleted_at')->get();
        return $result;
    }

  
}