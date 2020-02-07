<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionEntryRequest;
use App\Http\Requests\PermissionEditRequest;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Permission\PermissionRepositoryInterface;
use App\Core\Permission\Permission;
use App\Navigation\PermissionGroup\PermissionGroupRepository;
use Auth;


class PermissionController extends Controller
{
  private $permissionRepository;

  public function __construct(PermissionRepositoryInterface $permissionRepository)
  {
      $this->permissionRepository = $permissionRepository;
  }

  public function index(Request $request)
  {
    if(Auth::check()) {
          $permissions      = $this->permissionRepository->getPermissions();
          return view('core.permission.index')->with('permissions', $permissions);
     }
      return redirect('/');
  }

  public function create(){
    if(Auth::check()) {
          $permissionGroupRepo  = new PermissionGroupRepository();
          $permission_groups    = $permissionGroupRepo->getObjsWithLevel();

          return view('core.permission.permission')->with('permission_groups',$permission_groups);
      }
     return redirect('/');
  }

  public function store(PermissionEntryRequest $request)
  {
      try{
          $validated = $request->validated();
          $name                           = Input::get('name');
          $description                    = Input::get('description');
          $module                         = Input::get('module');
          $url                            = Input::get('url');
          $permission_gp_id               = Input::get('permission_group_id');

          $paramObj                       = new Permission();
          $paramObj->name                 = $name;
          $paramObj->module               = $module;
          $paramObj->url                  = $url;
          $paramObj->description          = $description;
          $paramObj->permission_group_id  = $permission_gp_id;

          $this->permissionRepository->create($paramObj);
          return redirect()->action('Core\PermissionController@index');
      }
      catch(\Exception $e){
          return redirect()->action('Core\PermissionController@index')
                           ->with(FormatGenerator::message('Fail', 'Permission did not create ...'));
      }
  }

  public function edit($id){
    if(Auth::check()) {    
          $permission               = $this->permissionRepository->getObjByID($id);
          if(isset($permission)){
              $permissionGroupRepo  = new PermissionGroupRepository();
              $permission_groups    = $permissionGroupRepo->getObjsWithLevel();

              return view('core.permission.permission')->with('permission', $permission)->with('permission_groups',$permission_groups);
          }
          else{
              return redirect()->action('Core\PermissionController@index')
                           ->with(FormatGenerator::message('Fail', 'Error in loading the permission to edit !!!'));
          }
      }
     return redirect('/');
  }

  public function update(PermissionEditRequest $request){
      try{
          $id                           = Input::get('id');
          $name                         = Input::get('name');
          $url                          = Input::get('url');
          $module                       = Input::get('module');
          $description                  = Input::get('description');
          //get permission_group
          $permission_group_id          = Input::get('permission_group_id');

          $paramObj                     = Permission::find($id);
          $paramObj->name               = $name;
          $paramObj->module             = $module;
          $paramObj->url                = $url;
          $paramObj->description        = $description;

          $paramObj->permission_group_id= $permission_group_id;

          $this->permissionRepository->update($paramObj);
          return redirect()->action('Core\PermissionController@index');
      }
      catch(\Exception $e){
          return redirect()->action('Core\PermissionController@index')
                           ->with(FormatGenerator::message('Fail', 'Permission did not update ...'));
      }
  }

  public function destroy(){
      $id         = Input::get('selected_checkboxes');
      $new_string = explode(',', $id);
      foreach($new_string as $id){
          $this->permissionRepository->delete($id);
      }
      return redirect()->action('Core\PermissionController@index');
  }
}
