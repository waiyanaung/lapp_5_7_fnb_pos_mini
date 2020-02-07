<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 2/15/2017
 * Time: 11:28 AM
 */

namespace App\Setup\FaqInformation;


interface FaqInformationRepositoryInterface
{
    public function getObjs();
    public function getObjsAll();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function activate($id);
    public function getArrays();
    public function checkToDelete($id);
}