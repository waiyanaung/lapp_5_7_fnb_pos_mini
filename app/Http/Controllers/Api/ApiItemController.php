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
use App\Setup\Category\CategoryRepository;
use App\Setup\Item\Item;
use App\Setup\Item\ItemRepositoryInterface;
use Auth;
use App\Setup\Brand\BrandRepository;
use App\Setup\Brand\Brand;

class ApiItemController extends Controller
{
    private $repo;

    public function __construct(ItemRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    public function getItems(Request $request)
    {

        if($request->ajax()){
            $inputs = Input::all();
            $filter = isset($inputs['filter']) ? $inputs['filter'] : null;
            $category_id = isset($inputs['category_id']) ? $inputs['category_id'] : null;
            $brand_id = isset($inputs['brand_id']) ? $inputs['brand_id'] : null;
            $returnedObj['laravelStatus'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['laravelStatusMessage'] = "fail";
            $returnedObj['objs'] = "";
            $item_list = "";

            if (Auth::check()) {

                // searching all items case
                if($filter == null){
                    $items = $this->repo->getObjsAllByLastItemFilter();
                }
                else{

                    // searching items by category case
                    if($filter == "category"){
                        $items = $this->repo->getItemByCategoryId($category_id);
                    }

                     // searching items by brand case
                    else if ($filter == "brand"){
                        $items = $this->repo->getItemByBrandId($brand_id);
                    }
                    
                    // all items case for exception case
                    else{
                        $items = $this->repo->getObjsAllByLastItemFilter();
                    }
                    
                }

                $item_list .= '<option value="" selected>Select Item</option>';
                if(isset($items) && count($items)>0){
                    foreach($items as $item){
                        $item_list .= '<option value="'. $item->id .'">'. $item->name .'</option>';
                    }
                    $returnedObj['laravelStatus'] = ReturnMessage::OK;
                    $returnedObj['laravelStatusMessage'] = "Success";                    
                }
                else{
                    $returnedObj['laravelStatusMessage'] = "fail, There is no items about this id!";
                    
                }
                $returnedObj['objs'] = $item_list;
                return response()->json(array('returnedObj'=> $returnedObj), ReturnMessage::OK);
                
            }
            return response()->json(array('returnedObj'=> $returnedObj), ReturnMessage::INTERNAL_SERVER_ERROR);
        }
        else{
            if (Auth::check()) {
                $items = $this->repo->getObjsAllByLastItemFilter();
                $categoryRepo = new CategoryRepository();
                $categories = $categoryRepo->getObjs();
    
                $countryRepo = new CountryRepository();
                $countries = $countryRepo->getObjs();
    
                $brand_repo = new BrandRepository();
                $brands = $brand_repo->getObjs();
                
                return view('backend.item.index')
                    ->with('objs', $items)
                    ->with('brands', $brands)
                    ->with('countries', $countries)
                    ->with('categories', $categories);
            }
            return redirect('/');
        }
        
    }

    public function getItem(Request $request)
    {

        if($request->ajax()){
            $item_id = Input::get('item_id');;
            $returnedObj['laravelStatus'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['laravelStatusMessage'] = "fail";
            $returnedObj['objs'] = array();

            if (Auth::check()) {
                if($item_id == null || $item_id == 0 || $item_id == ""){
                    $item = array();
                }
                else{
                    $item = $this->repo->getItemById($item_id);
                }
                
                if(isset($item) && count($item)>0){
                    $returnedObj['laravelStatus'] = ReturnMessage::OK;
                    $returnedObj['laravelStatusMessage'] = "Success";                
                    $returnedObj['objs'] = $item;
                }
                else{
                    $returnedObj['laravelStatusMessage'] = "Fail, There is no item about this id!";
                }                
                
                return response()->json(array('returnedObj'=> $returnedObj), ReturnMessage::OK);
            }
            return response()->json(array('returnedObj'=> $returnedObj), ReturnMessage::INTERNAL_SERVER_ERROR);
        }
        else{
            if (Auth::check()) {
                $items = $this->repo->getObjsAllByLastItemFilter();
                $categoryRepo = new CategoryRepository();
                $categories = $categoryRepo->getObjs();
    
                $countryRepo = new CountryRepository();
                $countries = $countryRepo->getObjs();
    
                $brand_repo = new BrandRepository();
                $brands = $brand_repo->getObjs();
                
                return view('backend.item.index')
                    ->with('objs', $items)
                    ->with('brands', $brands)
                    ->with('countries', $countries)
                    ->with('categories', $categories);
            }
            return redirect('/');
        }
        
    }

    public function getBrandsbyCategory(Request $request)
    {

        $inputs = Input::all();
        $category_id = isset($inputs['category_id']) ? $inputs['category_id'] : null;
        $returnedObj['laravelStatus'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        $returnedObj['laravelStatusMessage'] = "fail";
        $returnedObj['objs'] = "";
        $returnedObj['objs_count'] = 0;
        $item_list = "";
        $obj_count = 0;

        if($request->ajax()){           

            if (Auth::check()) {

                // searching all items case
                if($category_id == null){
                    $items = array();
                }
                else if($category_id == 0){
                    $items = $this->repo->getObjsAllByLastItemFilter();
                }
                else{
                    $items = $this->repo->getBrandsByCategoryId($category_id);                    
                }
                
                $item_list .= '<option value="" selected>Select Brand</option>';
                
                if(isset($items) && count($items)>0){
                    foreach($items as $item){
                        $item_list .= '<option value="'. $item->id .'">'. $item->name .'</option>';
                        $obj_count++;
                    }
                }
                
                $returnedObj['laravelStatus'] = ReturnMessage::OK;
                $returnedObj['laravelStatusMessage'] = "Success";                
                $returnedObj['objs'] = $item_list;
                $returnedObj['objs_count'] = $obj_count;
                return response()->json(array('returnedObj'=> $returnedObj), ReturnMessage::OK);
            }
            return response()->json(array('returnedObj'=> $returnedObj), ReturnMessage::INTERNAL_SERVER_ERROR);
        }
        else{
            return response()->json(array('returnedObj'=> $returnedObj), ReturnMessage::INTERNAL_SERVER_ERROR);
        }
        
    }

    
}
    
