<?php
/**
* Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 5/13/202020
 * Time: 3:51 PM
 */

namespace App\Setup\TransactionPayment;


interface TransactionPaymentRepositoryInterface
{
    public function getObjs();
    public function getObjsByCategoryId($category_id);
    public function getObjsByBrandId($brand_id);
    public function getObjsAll();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
    public function activate($id);
    public function getArrays();
    public function checkToDelete($id);
}