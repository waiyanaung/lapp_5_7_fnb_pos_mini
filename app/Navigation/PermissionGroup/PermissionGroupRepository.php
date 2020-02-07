<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/21/2016
 * Time: 3:51 PM
 */
namespace App\Navigation\PermissionGroup;

use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Navigation\PermissionGroup\PermissionGroup;
use App\Core\Permission\Permission;
use App\Core\Utility;
use App\Core\ReturnMessage;

class PermissionGroupRepository implements PermissionGroupRepositoryInterface
{
    public function getObjs()
    {
        $objs = PermissionGroup::whereNull('deleted_at')->get();
        return $objs;
    }
    public function getObjsWithLevel()
    {
        $objs = PermissionGroup::whereNull('deleted_at')->where('level',2)->get();
        return $objs;
    }
     public function getMenuWithLevel()
    {
        $objs = PermissionGroup::whereNull('deleted_at')->get();

        // $objs = DB::select("SELECT * FROM permission_groups WHERE deleted_at IS NULL");
        // foreach($objs as $obj){
        //     $id = $obj->id;
        //     $tempArr = DB::select("SELECT url FROM core_permissions WHERE permission_group_id = $id");
        //     // $tempArr = Permission::where('permission_group_id',$id)->first();
        //     $obj->url = $tempArr;
        // }


        // foreach ($objs as $key => $obj) {
        //     $tempObj[$obj->id]  = $obj;
        // }
        // $objs = DB::select("SELECT * FROM permission_groups WHERE level = 1 AND deleted_at IS NULL");
        // foreach($objs as $obj) {
        //     $get_max_level  = $this->getMaxLevel($obj);
        //     for ($i = 1; $i < $get_max_level; $i++) {
        //         $count  = $i + 1;
        //         $tempArr    =  DB::select("SELECT * FROM permission_groups WHERE level = $count AND group_code = $obj->group_code");
        //         $obj->submenu['level'][$count]   = $tempArr;
        //         // dd($tempArr);
        //     }
        //     $obj->max_count     = $get_max_level;
        // }
        // dd($objs);
        return $objs;
    }

    public function getMaxLevel($paramArr){
        $max_level      = PermissionGroup::where('status','=',1)->where('parent_id','=',$paramArr->parent_id)->whereNull('deleted_at')->max('parent_id');
        return $max_level;
    }

    public function getArrays()
    {
        $tbName = (new PermissionGroup())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL");
        return $arr;
    }
    public function getArrayByOrder()
    {
        $tbName = (new PermissionGroup())->getTable();
        $arr = DB::select("SELECT * FROM $tbName WHERE deleted_at IS NULL ORDER BY id DESC ");
        return $arr;
    }

    public function create($paramObj)
    {
        $returnedObj = array();
        $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        //$currentUser = Utility::getCurrentUserID(); //get currently logged in user
        $currentUser = 1;

        try {
            $tempObj = Utility::addCreatedBy($paramObj);
            $tempObj->save();

            //create info log
            $date = $tempObj->created_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created permission_group_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);


            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a permission_group and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function update($paramObj)
    {
        $returnedObj = array();
        $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        //$currentUser = Utility::getCurrentUserID(); //get currently logged in user
        $currentUser = 1;

        try {
            $tempObj = Utility::addUpdatedBy($paramObj);
            $tempObj->save();

            //update info log
            $date     = $tempObj->updated_at;
            $message  = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated city_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated city_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        //$currentUser = Utility::getCurrentUserID(); //get currently logged in user
        $currentUser = 1;

        try{
            $tempObj = PermissionGroup::find($id);
            $tempObj = Utility::addDeletedBy($tempObj);
            $tempObj->deleted_at = date('Y-m-d H:m:i');
            $tempObj->save();

            //delete info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted city_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  city_id = ' .$tempObj->id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function getObjByID($id){
        $role = PermissionGroup::find($id);
        return $role;
    }
}
