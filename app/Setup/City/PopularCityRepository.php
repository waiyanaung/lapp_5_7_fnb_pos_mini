<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/21/2016
 * Time: 3:51 PM
 */
namespace App\Setup\City;

use App\Log\LogCustom;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Setup\City\City;
use App\Core\Utility;
use App\Core\ReturnMessage;
class PopularCityRepository implements PopularCityRepositoryInterface
{
    public function create($cityArray)
    {
        $returnedObj = array();
        $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;

        $currentUser = Utility::getCurrentUserID(); //get currently logged in user

        try {

            foreach($cityArray as $city_id=>$order){
                //check whether the record with this city_id already exists in popular_cities table or not
                $checkPopular = DB::table('popular_cities')->where('city_id','=',$city_id)->get();

                if(isset($checkPopular) && count($checkPopular)>0){
                    //find city_id and update order
                    DB::table('popular_cities')
                        ->where('city_id', $city_id)
                        ->update(['order' => $order]);

                }
                else{
                    if($order != "" || null){
                        //insert
                        DB::table('popular_cities')->insert(
                            ['order' => $order, 'city_id' => $city_id]
                        );
                    }
                }
            }


            //create info log
            $date = date('Y-m-d H:i:s'); //get current date for log
            $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' set popular_cities.' . PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            return $returnedObj;
        }
        catch(\Exception $e){
            //create error log
            $date = date('Y-m-d H:i:s'); //get current date for log
            $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' set popular_cities and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
            LogCustom::create($date,$message);

            $returnedObj['laravelStatusMessage'] = $e->getMessage();
            return $returnedObj;
        }
    }

    public function getOrderByCityId($city_id){
        $result = DB::table('popular_cities')->where('city_id','=',$city_id)->first();
        return $result;
    }

    public function getObjs()
    {
        $rawObjs = DB::table('popular_cities')->orderBy('order','asc')->where('order','<>',0)->get();
        
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }
}