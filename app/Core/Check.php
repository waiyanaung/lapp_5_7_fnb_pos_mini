<?php

namespace App\Core;

use App\Core\Config\ConfigRepository;
use Validator;
use Auth;
use App\Http\Requests;
use App\Session;
use App\Core\User\UserRepository;
use App\Setup\FrontedClient\FrontedClient;
use App\Setup\Backend\Backend;
use App\Navigation\PermissionGroup\PermissionGroupRepository;
use DB;

class Check
{
    /**
     *
     * @return bool
     */
    public static function validSession()
    {
        $sessionObj = session('user');
        if(isset($sessionObj)){
            return true;
        }
        return false;
    }

    public static function validSessionCustomer()
    {
        $sessionObj = session('customer');
        if(isset($sessionObj)){
            return true;
        }
        return false;
    }

    public static function getSessionCustomer()
    {
        $sessionObj = session('customer');
        if(isset($sessionObj)){
            return $sessionObj;
        }
        return false;
    }

    

    public static function hasPermission($permissions,$routeAction) {

        if(isset($permissions) && count($permissions)>0) {
            foreach ($permissions as $key => $permission) {
                if ($permission['url'] == $routeAction) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $methodString
     * @param $method
     * @return bool
     */
    public static function hasMethods($methodString,$method) {
        $methods = explode('|', $methodString);
        return (in_array("*", $methods) || in_array($method, $methods));
    }

     /**
     * @return mixed
     */
    public static function logout() {
        //flush session
        Session::flush();

        //redirect user to login page
        return Redirect::to('/backend/login');
    }

    public static function getInfo() {
        $info = array();
        $info['companyName'] = "";
        if(Check::validSession()) {
            $info['userName'] = strtoupper(session('user')['user_name']);
            $info['userId'] = session('user')['id'];
            $info['userRoleId'] = session('user')['role_id'];
        }
        return $info;
    }

    public static function companyLogo() {

        $ConfigRepository = new ConfigRepository();
        $companyLogo = $ConfigRepository->getCompanyLogo();

        if(isset($companyLogo) && count($companyLogo)>0 ) {

            if(isset($companyLogo[0]->value) && $companyLogo[0]->value != ""){
                return $companyLogo[0]->value;
            }
            else{
                return "/images/laravel-logo.png";
            }
        }
        return "/images/laravel-logo.png";
    }

    public static function companyName() {

        $ConfigRepository = new ConfigRepository();
        $companyName = $ConfigRepository->getCompanyName();

        if(isset($companyName) && count($companyName)>0 ) {

            if(isset($companyName[0]->value) && $companyName[0]->value != ""){
                return $companyName[0]->value;
            }
            else{
                return "Laravel Backend";
            }
        }
        return "Laravel Backend";
    }

    public static function adminEmails() {

        $ConfigRepository = new ConfigRepository();
        $companyEmails = $ConfigRepository->getAdminEmails();

        if(isset($companyEmails) && count($companyEmails)>0 ) {

            if(isset($companyEmails[0]->value) && $companyEmails[0]->value != ""){
                return $companyEmails[0]->value;
            }
            else{
                return "";
            }
        }
        return "";
    }

    public static function createSession($id) {

        $userRepository = new UserRepository();
        $tempUser = $userRepository->getObjByID($id);
        $permissions = $userRepository->getPermissionByUserId($id);
        session(['user'=>$tempUser->toArray()]);
        session(['permissions' => $permissions]);
    }

    public static function createNavSession() {

        $menuRepository = new PermissionGroupRepository();
        $menus = $menuRepository->getMenuWithLevel();
        // foreach($getlevels as $getlevel){
        //     $level = $getlevel->level;
        // }
        // $menus = $menuRepository->getMenuWithLevel($level);
        session(['menu' => $menus]);
    }

    public static function createSessionCustomer($id){
        $repo         = new UserRepository();
        $tempCustomer = $repo->getObjByID($id);
        session(['customer' =>$tempCustomer->toArray()]);
    }

    public static function getTableIncrementId($table_name,$date){

        // $total_count = DB::select("select count(id) from " . $table_name . " where date = '". $date . "'");
        $total_count = DB::table($table_name)->where('date', $date)->count();
        $last_id_raw = $total_count + 1;
        $id_length = strlen($last_id_raw);
        $id_total_length = 6 - $id_length;

        $last_id = $date . '-';
        for($i = 0; $i < $id_total_length; $i++ ){
            $last_id .= '0';
        }
        $last_id .= $last_id_raw;
        
        return $last_id;
    }

}
