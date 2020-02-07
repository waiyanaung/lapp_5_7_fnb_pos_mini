<?php
/**
 * Created by Visual Studio Code.
 * User: william
 * Author: Wai Yan Aung
 * Date: 1/14/2017
 * Time: 10:55 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Setup\Category\CategoryRepository;
use App\Setup\Item\ItemRepositoryInterface;
use Illuminate\Http\Request;
use App\Setup\Country\CountryRepository;
use App\Setup\Brand\BrandRepository;
use Illuminate\Support\Facades\Input;

class ItemController extends Controller
{

    public function __construct(ItemRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {            
        $brand_id = Input::get('brand_id');
        $item_horse_power_id = Input::get('item_horse_power_id');
        $item_cooling_capacity_id = Input::get('item_cooling_capacity_id');
        $objs = $this->repo->getObjsByFilters($brand_id,$item_horse_power_id,$item_cooling_capacity_id);
        
        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->getObjs();

        $selected_category_name = "all categories";

        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->getObjs();

        $countryRepo = new CountryRepository();
        $countries = $countryRepo->getObjs();

        $brand_repo = new BrandRepository();
        $brands = $brand_repo->getObjs();
            
        return view('frontend.item')
            ->with('objs', $objs)
            ->with('countries',$countries)
            ->with('brands', $brands)            
            ->with('categories', $categories)
            ->with('selected_category_name', $selected_category_name)
            ->with('brand_id',$brand_id)
            ->with('item_horse_power_id',$item_horse_power_id)
            ->with('item_cooling_capacity_id',$item_cooling_capacity_id);
    }
}
