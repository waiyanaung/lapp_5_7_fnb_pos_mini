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
use Illuminate\Http\Request;
use App\Setup\Category\CategoryRepositoryInterface;
use App\Setup\Item\ItemRepository;
use App\Setup\Category\CategoryRepository;
use App\Setup\Country\CountryRepository;
use App\Setup\Brand\BrandRepository;

class CategoryController extends Controller
{

    public function __construct(CategoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        $objs = $this->repo->getObjs();
        return view('frontend.category')->with('objs', $objs);
    }

    public function detail($category_id)
    {
        $itemRepo       = new ItemRepository();
        $objs          	= $itemRepo->getObjsByCategoryId($category_id);

		$categoryRepo       = new CategoryRepository();
        $categories         = $categoryRepo->getObjs();        

        $countryRepo = new CountryRepository();
        $countries = $countryRepo->getObjs();

        $brand_repo = new BrandRepository();
        $brands = $brand_repo->getObjs();        

        $selected_category_name	= "";
        $selectedCategory = $categoryRepo->getObjByID($category_id);
        if (isset($selectedCategory)) {
            $selected_category_name	= $selectedCategory->name . " category";
        }

        $selected_brand_name = "";
        
		return view('frontend.item')
					->with('objs',$objs)
					->with('countries',$countries)
                    ->with('brands', $brands)                   
                    ->with('categories', $categories)
					->with('selected_category_name',$selected_category_name)
                    ->with('selected_brand_name', $selected_brand_name)
                    ->with('brand_id',0)
                    ->with('item_horse_power_id',0)
                    ->with('item_cooling_capacity_id',0);
    }

}
