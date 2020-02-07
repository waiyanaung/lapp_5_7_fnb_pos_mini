<?php
/**
 * Created by Visual Studio Code.
 * User: User
 * Date: 3/19/2017
 * Time: 10:27 PM
 */

namespace App\Setup\Slider;


interface SliderRepositoryInterface
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