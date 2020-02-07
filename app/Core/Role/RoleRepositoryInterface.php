<?php

namespace App\Core\Role;


interface RoleRepositoryInterface
{
    public function getRoles();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function check_staff($id);
    public function getRolePermissions($id);
    public function getPermissionsByRoleId($id);
    public function getPermissionsRoleByRoleIdNPermissionId($rId,$pId);
    public function updatePermissionsRoleByRoleIdNPermissionId($rId,$pId);
    public function getObjs();
    public function getObjsAll();
    public function activate($id);
    
}
