<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 2/15/2017
 * Time: 11:28 AM
 */

namespace App\Setup\TransactionItemTemp;


interface TransactionItemTempRepositoryInterface
{
    public function getObjs();
    public function getObjsByCategoryId($category_id);
    public function getObjsByBrandId($brand_id);
    public function getObjsByFilters($brand_id,$item_horse_power_id,$item_cooling_capacity_id);
    public function getObjsAll();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function activate($id);
    public function getArrays();
    public function checkToDelete($id);
}