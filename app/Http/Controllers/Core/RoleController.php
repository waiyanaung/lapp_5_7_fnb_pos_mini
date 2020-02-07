<?php
namespace App\Http\Controllers\Core;

use App\Core\User\UserRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleEntryRequest;
use App\Http\Requests\RoleEditRequest;
use App\Core\Role\RoleRepositoryInterface;
use App\Core\Role\Role;
//use App\Core\Permission\Permission;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\Permission\PermissionRole;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Utility;

class RoleController extends Controller
{
    private $repo;

    public function __construct(RoleRepositoryInterface $repo)
    {        
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
       if(Auth::check()) {
        $roles      = $this->repo->getObjsAll();

        return view('core.role.index')->with('roles', $roles);
        }
        return redirect('/backend/login');
    }

    public function create(){
        if(Auth::check()) {
            return view('core.role.role');
        }
        return redirect('/backend/login');
    }

    public function store(RoleEntryRequest $request)
    {
        try{
            $validated      = $request->validated();
            $role_name      = Input::get('name');
            $status         = Input::get('status');
            $description    = Input::get('description');
            $remark         = Input::get('remark');
            $detail_info    = Input::get('detail_info');

            //Start Saving Image
            $removeImageFlag    = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
            $path               = base_path().'/public/images/role/';

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

            $paramObj                   = new Role();
            $paramObj->name             = $role_name;
            $paramObj->status           = $status;
            $paramObj->description      = $description;
            $paramObj->remark           = $remark;
            $paramObj->detail_info      = $detail_info;
            $paramObj->image_url        = '/images/role/' . $image_url_name;

            $result = $this->repo->create($paramObj);
            if($result['laravelStatusCode'] ==  ReturnMessage::OK){

                return redirect()->action('Core\RoleController@index')
                    ->with(FormatGenerator::message('Success', 'Role is created ...'));
            }
            else{
                return redirect()->action('Core\RoleController@index')
                    ->with(FormatGenerator::message('Fail', 'Role is not created ...'));
            }
        }
        catch(\Exception $e){
            return redirect()->action('Core\RoleController@index')
            ->with(FormatGenerator::message('Fail', 'Role did not create ...'));
        }
    }

    public function edit($id){
        if(Auth::check()) {
        $role = $this->repo->getObjByID($id);
        if(isset($role)){
            return view('core.role.role')->with('obj', $role);
        }
        else{
            return redirect()->action('Core\RoleController@index')
            ->with(FormatGenerator::message('Fail', 'Error in loading the role to edit !!!'));
        }
       }
       return redirect('/backend/login');
    }

    public function update(RoleEditRequest $request){
        try{
            $validated = $request->validated();
            $id                         = Input::get('id');
            $role_name                  = Input::get('name');
            $status                     = Input::get('status');
            $description                = Input::get('description');
            $remark                     = Input::get('remark');
            $detail_info                = Input::get('detail_info');        
            
            $removeImageFlag            = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
            $path                       = base_path().'/public/images/role/';        
            $remove_old_image               = false;

            $paramObj                   = Role::find($id);
            $old_image                  = $paramObj->image_url;
            $paramObj->name             = $role_name;
            $paramObj->status           = $status;
            if($id == 1) {
                $paramObj->status           = 1;
            }
            $paramObj->description      = $description;
            $paramObj->remark           = $remark;
            $paramObj->detail_info      = $detail_info;

            if(Input::hasFile('image_url'))
            {   
                //Start Saving Image
                $image_url                  = Input::file('image_url');
                $image_url_name_original    = Utility::getImage($image_url);
                $image_url_ext              = Utility::getImageExt($image_url);
                $image_url_name             = uniqid() . "." . $image_url_ext;
                $image                      = Utility::resizeImage($image_url,$image_url_name,$path);
                $remove_old_image           = true;
                $paramObj->image_url        = '/images/role/' . $image_url_name;
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

                return redirect()->action('Core\RoleController@index')
                    ->with(FormatGenerator::message('Success', 'Role is updated ...'));
            }
            else{

                return redirect()->action('Core\RoleController@index')
                    ->with(FormatGenerator::message('Fail', 'Role is not updated ...'));
            }
        }
        catch(\Exception $e){
            return redirect()->action('Core\RoleController@index')
            ->with(FormatGenerator::message('Fail', 'Role did not update ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Core\RoleController@index')->with(FormatGenerator::message('Success', 'activated successfully   !!!')); 
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Core\RoleController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }
    
    public function rolePermission($id)
    {
        if (Auth::check()) {
            $role = $this->repo->getObjByID($id);
            if(isset($role)){
                $rolePermissions = $this->repo->getRolePermissions($id);
                return view('core.role.rolePermission')->with('role',$role)->with('features_permissions',$rolePermissions);
            }
            else{
                return redirect()->action('Core\RoleController@index')
                ->with(FormatGenerator::message('Fail', 'Error in loading the role permission to edit !!!'));
            }
        }
        return redirect('/backend_app/login');
    }

    public function rolePermissionAssign($rid)
    {
        $inputs = Input::all();
        if(isset($inputs['module'])) {
            $fId = $inputs['module'];
        }
        else {
            return redirect()->action('Core\RoleController@index');
        }

        $temp_current_permissions_id = $this->repo->getPermissionsByRoleId($rid);

        $current_permissions_id = [];
        if(count($temp_current_permissions_id)> 0) {
            foreach($temp_current_permissions_id as $key=>$v) {
                $current_permissions_id[$key] = $v->permission_id;
            }

        }

        foreach($inputs as $key=>$value)
        {
            $is_permission_added_in_current_role = false;
            if($key == '_token') continue;
            if($key == 'module') continue;
            $permission_id = explode("_", $key) [1];
            $is_permission_added_in_current_role = in_array($permission_id, $current_permissions_id);

            $existedPermission = $this->repo->getPermissionsRoleByRoleIdNPermissionId($rid,$permission_id);

            if(!$is_permission_added_in_current_role && $value == 'on')
            {
                //echo 'ON'; print_r ($current_permissions_id); echo $permission_id.'->'; echo $is_permission_added_in_current_role; echo '<br>';
                //if the permission is not exist, create new permission role record.

                if(isset($existedPermission) && count($existedPermission)>0) {
                    if($this->repo->updatePermissionsRoleByRoleIdNPermissionId($rid,$permission_id)) {
                        return Redirect::to('/roles/' . $rid)
                        ->with(FormatGenerator::message('Error', 'Update Fail!'));
                    }
                    else{

                    }
                }
                else{
                    $new_permission = new PermissionRole();
                    $new_permission->role_id = $rid;
                    $new_permission->permission_id = $permission_id;
                    $new_permission->save();
                }
            }
            //if permission is in the current role, but it was turn off.
            else if($is_permission_added_in_current_role)
            {
                if($value == 'off'){

                    //if permission record is exist (true), find and do a delete.
                    $perm = PermissionRole::where('role_id', $rid)->where('permission_id', $permission_id)->first();

                    if(isset($perm)){
                        $perm->delete();
                    }
                    //else it is not exist, do nothing.
                }
                else if($value == 'on')
                {
                    //echo 'ON'; print_r ($current_permissions_id); echo $permission_id.'->'; echo $is_permission_added_in_current_role; echo '<br>';
                    //do nothing ....
                }
            }
        }

        // Change User's Session Permissions
        $sessionUser = session('user');
        $userId = $sessionUser['id'];
        $userRepository = new UserRepository();
        $permissions = $userRepository->getPermissionByUserId($userId);
        session(['permissions' => ""]);
        session(['permissions' => $permissions]);
        $role = $this->repo->getObjByID($rid);
        $rolePermissions = $this->repo->getRolePermissions($rid);
        return view('core.role.rolePermission')->with('role',$role)->with('features_permissions',$rolePermissions);

        // return redirect()->action('Core\RoleController@index');
    }

}
