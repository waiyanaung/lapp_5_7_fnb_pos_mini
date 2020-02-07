<?php

namespace App\Core\Role;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Permission\Permission;
use App\Core\Permission\PermissionRole;
use App\Core\Utility;
use App\Core\ReturnMessage As ReturnMessage;
use App\Log\LogCustom;

class RoleRepository implements RoleRepositoryInterface
{
    public function getRoles()
    {
        $roles = Role::whereNull('deleted_at')->get();
        return $roles;
    }

    public function getObjs()
    {
        $objs = Role::whereNull('deleted_at')->get();
        return $objs;
    }

    public function getObjsAll()
    {
        $objs = Role::all();
        return $objs;
    }    

    public function getObjByID($id){
        $role = Role::find($id);
        return $role;
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
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created user_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //create error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a role and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
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
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated user_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //update error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated user_id = ' .$id. ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            if($id != 1){
                $tempObj = Role::find($id);
                $tempObj = Utility::addDeletedBy($tempObj);
                $tempObj->deleted_at = date('Y-m-d H:m:i');
                $tempObj->status = 0;
                $tempObj->save();

                //delete info log
                $date = $tempObj->deleted_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' deleted user_id = '.$tempObj->id . PHP_EOL;
                LogCustom::create($date,$message);
            }
            else{
                $message = '['. $date .'] '. 'error : ' . 'User '.$currentUser.' deleted user_id = '.$id . PHP_EOL;
                LogCustom::create($date,$message);
            }
        }
        catch(\Exception $e){
            //delete error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleted  user_id = ' . $id . ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function activate($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            $tempObj = Role::find($id);
            $tempObj = Utility::addUpdatedBy($tempObj);
            $tempObj->deleted_at = NULL;
            $tempObj->deleted_by = NULL;
            $tempObj->status = 1;
            $tempObj->save();

            //activate info log
            $date = $tempObj->deleted_at;
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' activated user_id = '.$tempObj->id . PHP_EOL;
            LogCustom::create($date,$message);
        }
        catch(\Exception $e){
            //activate error log
            $date    = date("Y-m-d H:i:s");
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' deleactivatedted  user_id = ' . $id . ' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);
        }
    }

    public function check_staff($id){
        $subcategory = DB::table('core_roles')->where('role_id', '=', $id)->first();//check whether there are users of this user_type
        return $subcategory;
    }

    public function getRolePermissions ($role_id)
    {

        $result = [];

        $rel = DB::select("SELECT distinct module FROM core_permissions ORDER BY module");
        $features = json_decode(json_encode($rel), true);
        foreach ($features as $feature)
        {
            $permissions = [];
            $feature_permissions = Permission::where('module', $feature['module'])->get();

            foreach($feature_permissions as $fp)
            {
                $pivot = PermissionRole::whereNull('deleted_at')->where('role_id', $role_id)->where('permission_id', $fp->id)->first();
                $checked = ( count( (array)$pivot ) > 0 ) ? true : false;

                $permissions [] = [
                    'id' =>$fp->id,
                    'feature_id'=>$fp->feature_id,
                    'name'=>$fp->name,
                    'descr'=>$fp->descr,
                    'module'=>$fp->module,
                    'position'=>$fp->position,
                    'url'=>$fp->url,
                    'checked'=>$checked
                ];
            }


            $result [] = [
                'feature'=>$feature,
                'permissions'=>$permissions
            ];
        }

        // get result ...
        return $result;
    }

    public function getPermissionsByRoleId($rId)
    {
        $array = [];
        try {
            $tb = (new PermissionRole())->getTable();
            $result = DB::select("SELECT * FROM $tb
                                    WHERE role_id = '$rId'
                                ");

            if (isset($result) && count($result) > 0) {
                return $result;
            } else {
                return $array;
            }
        } catch (Exception $ex) {
            return $array;
        }

    }

    public function getPermissionsRoleByRoleIdNPermissionId($rId,$pId){
        $array = [];
        try{
            $tb = (new PermissionRole())->getTable();
            $result = DB::select("SELECT * FROM $tb
                                WHERE role_id = '$rId'
                                AND permission_id = '$pId'
                            ");

            if(isset($result) && count($result)>0) {
                return $result;
            }
            else {
                return $array;
            }
        }
        catch(Exception $ex){
            return $array;
        }

    }

    public function updatePermissionsRoleByRoleIdNPermissionId($rId,$pId){

        try{
            $tb = (new PermissionRole())->getTable();
            $result =  DB::table($tb)
                ->where('role_id', $rId)
                ->where('permission_id', $pId)
                ->update(array('deleted_at' => null));

            if($result) {
                return true;
            }
            else{
                return false;
            }
        }
        catch(Exception $ex){
            return false;
        }

    }

}
