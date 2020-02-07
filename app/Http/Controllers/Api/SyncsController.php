<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Core\Utility;
use App\Setup\Country\CountryRepository;

use App\Http\Requests;
use App\Setup\City\City;
use App\Setup\Country\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class SyncsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function down()
    {
        $temp   = Input::All();

        $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        //$returnedObj['data'] = (object) array();
        $resultArray = array();
        $resultArray['categories'] = array();        
        $resultArray['items'] = array();        
        $resultArray['item_images'] = array();
        $resultArray['townships'] = array();
        $resultArray['cities'] = array();
        $resultArray['countries'] = array();        

        try {            

            $categories = DB::select("SELECT * FROM categories");
            $categories = $this->removeNullFromArray($categories);
            $resultArray['categories'] = $categories;            

            $items = DB::select("SELECT * FROM items");
            $items = $this->removeNullFromArray($items);
            $resultArray['items'] = $items;

            $item_images = DB::select("SELECT * FROM item_images");
            $item_images = $this->removeNullFromArray($item_images);
            $resultArray['item_images'] = $item_images;

            $townships = DB::select("SELECT * FROM townships");
            $townships = $this->removeNullFromArray($townships);
            $resultArray['townships'] = $townships;            

            $cities = DB::select("SELECT * FROM cities");
            $cities = $this->removeNullFromArray($cities);
            $resultArray['cities'] = $cities;

            $suppliers = DB::select("SELECT * FROM core_users WHERE role_id = 6");
            $suppliers = $this->removeNullFromArray($suppliers);
            $resultArray['suppliers'] = $suppliers;

            $countries = DB::select("SELECT * FROM countries");
            $countries = $this->removeNullFromArray($countries);
            $resultArray['countries'] = $countries;

            $brands = DB::select("SELECT * FROM brands");
            $brands = $this->removeNullFromArray($brands);
            $resultArray['brands'] = $brands;
            
        
            $returnedObj['laravelStatusCode'] = ReturnMessage::OK;
            $returnedObj['laravelStatusMessage'] = "There is no tables to syncs down!";
            $returnedObj['data'] = $resultArray;
            return \Response::json($returnedObj);

        } catch(\Exception $e){

            $returnedObj['laravelStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['laravelStatusMessage'] = $e->getMessage();
            $returnedObj['data'] = $resultArray;
            return \Response::json($returnedObj);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function removeNullFromArray($data)
    {    
        foreach ($data as $key => $value) {
            
            foreach ($value as $key2 => $value2) {                
                if (is_null($value2)) {
                    $data[$key]->$key2 = 0;
                }
            }            
            
        }
        return $data;
    }
}
    
