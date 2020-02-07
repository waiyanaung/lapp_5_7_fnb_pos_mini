<?php
/**
 * Created by Visual Studio Code.
 * User: william
 * Author: Wai Yan Aung
 * Date: 1/14/2017
 * Time: 10:55 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Setup\Item\ItemRepository;
use App\Setup\Country\CountryRepository;
use App\Http\Controllers\Controller;
use App\Setup\Category\CategoryRepository;
use App\Setup\Brand\BrandRepositoryInterface;
use Illuminate\Http\Request;
use App\Setup\Brand\BrandRepository;

class BrandController extends Controller
{

    public function __construct(BrandRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $objs = $this->repo->getObjs();
        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->getObjs();

        $selected_category_name = "all categories";

        return view('frontend.brand')
            ->with('objs', $objs)
            ->with('categories', $categories)
            ->with('selected_category_name', $selected_category_name);
    }

    public function detail($brand_id)
    {
        $itemRepo       = new ItemRepository();
        $objs          	= $itemRepo->getObjsByBrandId($brand_id);

		$categoryRepo       = new CategoryRepository();
        $categories         = $categoryRepo->getObjs();        

        $countryRepo = new CountryRepository();
        $countries = $countryRepo->getObjs();

        $brand_repo = new BrandRepository();
        $brands = $brand_repo->getObjs();       

        $selected_category_name	= "";
        $selected_brand = $brand_repo->getObjByID($brand_id);
        if (isset($selected_brand)) {
            $selected_brand_name	= $selected_brand->name . " brand";
        }
        
		return view('frontend.item')
					->with('objs',$objs)
					->with('countries',$countries)
                    ->with('brands', $brands)
                    ->with('categories', $categories)
                    ->with('selected_category_name',$selected_category_name)
                    ->with('selected_brand_name', $selected_brand_name)
                    ->with('brand_id',$brand_id)
                    ->with('item_horse_power_id',0)
                    ->with('item_cooling_capacity_id',0);
    }
}
