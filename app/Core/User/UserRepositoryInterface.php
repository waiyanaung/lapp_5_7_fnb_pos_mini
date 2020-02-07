<?php namespace App\Core\User;

/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 5/21/2016
 * Time: 3:51 PM
 */
interface UserRepositoryInterface
{
    public function getUsers();
    public function getAllUsers();
    public function getUsersForAdmin();
    public function getUsersForManager();    
    public function getAllUsersForManager();
    public function getObjByID($id);
    public function create($paramObj);
    public function update($paramObj);
    public function delete_users($id);
    public function getRoles();
    public function changeDisableToEnable($id,$cur);
    public function changeEnableToDisable($id);

}