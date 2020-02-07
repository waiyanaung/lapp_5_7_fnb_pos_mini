<?php

namespace App\Http\Controllers\Navigation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionGroupEntryRequest;
use App\Http\Requests\PermissionGroupEditRequest;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Navigation\PermissionGroup\PermissionGroupRepositoryInterface;
use App\Navigation\PermissionGroup\PermissionGroup;


class PermissionGroupController extends Controller
{
	private $permissionGroupRepository;

    public function __construct(PermissionGroupRepositoryInterface $permissionGroupRepository)
    {
        $this->permissionGroupRepository = $permissionGroupRepository;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $menus      = $this->permissionGroupRepository->getObjs();
            return view('core.menu.index')->with('menus', $menus);
        }
        return redirect('/');
    }

    public function create(){
        if(Auth::check()) {
            return view('core.menu.menu');
        }
        return redirect('/');
    }

    public function store(PermissionGroupEntryRequest $request)
    {
        try{
            $validated = $request->validated();
            $name                 = Input::get('name');
            $level    		        = Input::get('level');
            $group_code    	      = Input::get('group_code');

            $paramObj             = new PermissionGroup();
            $paramObj->name       = $name;
            $paramObj->level      = $level;
            $paramObj->group_code = $group_code;
            $paramObj->parent_id  = 0;

            $this->permissionGroupRepository->create($paramObj);
            return redirect()->action('Navigation\PermissionGroupController@index');
        }
        catch(\Exception $e){
            return redirect()->action('Navigation\PermissionGroupController@index')
                             ->with(FormatGenerator::message('Fail', 'Menu did not create ...'));
        }
    }

    public function edit($id){
        if(Auth::check()) {
            $menu = $this->permissionGroupRepository->getObjByID($id);
            if(isset($menu)){
                return view('core.menu.menu')->with('menu', $menu);
            }
            else{
                return redirect()->action('Navigation\PermissionGroupController@index')
                             ->with(FormatGenerator::message('Fail', 'Error in loading the menu to edit !!!'));
            }
       }
        return redirect('/');
    }

    public function update(PermissionGroupEditRequest $request){
        try{
            $id                   = Input::get('id');
            $name                 = Input::get('name');
            $level    		        = Input::get('level');
            $group_code    	      = Input::get('group_code');

            $paramObj             = PermissionGroup::find($id);
            $paramObj->name       = $name;
            $paramObj->level      = $level;
            $paramObj->group_code = $group_code;
            $paramObj->parent_id  = 0;

            $this->permissionGroupRepository->update($paramObj);
            return redirect()->action('Navigation\PermissionGroupController@index');
        }
        catch(\Exception $e){
            return redirect()->action('Navigation\PermissionGroupController@index')
                             ->with(FormatGenerator::message('Fail', 'Menu did not update ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->permissionGroupRepository->delete($id);
        }
        return redirect()->action('Navigation\PermissionGroupController@index');
    }
}
