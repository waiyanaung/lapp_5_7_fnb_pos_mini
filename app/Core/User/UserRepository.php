<?php

namespace App\Core\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Core\Permission\PermissionRepository;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Log\LogCustom;
use Auth;
class UserRepository implements UserRepositoryInterface
{
    public function create($userObj)
    {
        $returnedObj = array();
        $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $tempObj = Utility::addCreatedBy($userObj);
        $tempObj->save();

        $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
        return $returnedObj;
    }

    public function update($userObj)
    {
        $returnedObj = array();
        $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $tempObj = Utility::addUpdatedBy($userObj);
        $tempObj->save();

        $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
        return $returnedObj;
    }

    public function getUsers()
    {
        $users = User::whereNull('deleted_at')->get();
        return $users;
    }

    public function getAllUsers()
    {
        $users = User::all();
        return $users;
    }


    public function getUsersForAdmin()
    {
        $roleIdAry =  array(2,3,4,5);
        $users = User::whereIn('role_id',$roleIdAry)->get();
        return $users;
    }
    
    public function getUsersForVerifier()
    {
        $roleIdAry =  array(3,4,5);
        $users = User::whereIn('role_id',$roleIdAry)->get();
        return $users;
    }

    public function getUsersForInspector()
    {
        $roleIdAry =  array(4,5);
        $users = User::whereIn('role_id',$roleIdAry)->get();
        return $users;
    }

    public function getUsersForContractor()
    {
        $roleIdAry =  array(5);
        $users = User::whereIn('role_id',$roleIdAry)->get();
        return $users;
    }

    public function getUsersForManager()
    {
        $users = User::whereNull('deleted_at')->where('role_id' ,'=', 3)->get();
        return $users;
    }

    public function getAllUsersForManager()
    {
        $users = User::where('role_id' ,'=', 3)->get();
        return $users;
    }

    public function getUsersByRoleId($role_id)
    {
        $users = User::whereNull('deleted_at')->where('status' ,'=', 1)->where('role_id' ,'=', $role_id)->get();
        return $users;
    }

    public function getUserByEmail($email){
        $user = DB::select("SELECT * FROM core_users WHERE email = '$email'");
        return $user;
    }

    public function getRoles(){

        $role_id = Auth::user()->role_id;
            switch ($role_id) {
                case 1:
                    $roles = DB::table('core_roles')->whereNull('deleted_at')->get();
                    break;
                case 2:
                    $roles = DB::table('core_roles')->where('id','>=', 2)->whereNull('deleted_at')->get();
                    break;
                case 3:
                    $roles = DB::table('core_roles')->where('id','>=', 3)->whereNull('deleted_at')->get();
                    break;
                case 4:
                    $roles = DB::table('core_roles')->where('id','>=', 4)->whereNull('deleted_at')->get();
                    break;
                default:
                    $roles = DB::table('core_roles')->where('id','>=', 5)->whereNull('deleted_at')->get();
                    break;
            }

        
        return $roles;
    }

    public function delete_users($id){
        if($id != 1){
            //DB::table('core_users')->where('id',$id)->update(['deleted_at'=> date('Y-m-d H:m:i')]);
            $userObj = User::find($id);
            $userObj = Utility::addDeletedBy($userObj);
            $userObj->deleted_at = date('Y-m-d H:m:i');
            $userObj->save();
        }
    }

    public function delete($id)
    {
        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try{
            if($id != 1){
                $tempObj = User::find($id);
                $tempObj = Utility::addDeletedBy($tempObj);
                $tempObj->deleted_at = date('Y-m-d H:m:i');
                $tempObj->status = 2;
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
            $tempObj = User::find($id);
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

    public function getObjByID($id){
        $user = User::find($id);
        return $user;
    }

    public function changeDisableToEnable($id,$cur){
        DB::table('core_users')->where('id',$id)->update(['last_activity'=>$cur,'status'=>1]);
    }

    public function changeEnableToDisable($id)
    {
        DB::table('core_users')->where('id',$id)->update(['status'=>0]);
    }


    public function getPermissionByUserId($userId) {

        $roleId = DB::table("core_users")
            ->select('role_id')
            ->where('id' , '=' , $userId)
            ->first();

        if($roleId) {
            $permissionRepo = new PermissionRepository();
            $permissions = $permissionRepo->getPermissionsByRoleId($roleId->role_id);

            if($permissions)
                return $permissions;
        }
        return null;
    }
}
