<?php
namespace App\Setup\Customer;
/**
 * Created by Visual Studio Code.
 * Author: Khin Zar Ni Wint
 * Date: 4/26/2017
 * Time: 3:23 PM
 */
interface CustomerRepositoryInterface
{
    public function create($paramObj);
    public function getObjByID($id);
    public function update($paramObj);
}