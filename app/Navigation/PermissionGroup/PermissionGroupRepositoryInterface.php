<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 2/15/2017
 * Time: 11:28 AM
 */

namespace App\Navigation\PermissionGroup;


interface PermissionGroupRepositoryInterface
{
    public function getObjs();
    public function getObjsWithLevel();
    public function getMenuWithLevel();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function getArrays();
    public function getArrayByOrder();
}