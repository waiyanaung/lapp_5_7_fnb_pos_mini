<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 2/15/2017
 * Time: 11:28 AM
 */

namespace App\Setup\City;


interface PopularCityRepositoryInterface
{
    public function create($paramObj);
    public function getOrderByCityId($city_id);
    public function getObjs();
}