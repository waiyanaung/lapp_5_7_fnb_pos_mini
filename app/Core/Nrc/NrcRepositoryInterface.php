<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 2/15/2017
 * Time: 11:28 AM
 */

namespace App\Core\Nrc;


interface NrcRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function getUserNrc($id);
    public function getUserNrcArr($id);
    public function delete($id);
    public function getArrays();
    public function getArrayByOrder();
    public function checkToDelete($id);
}