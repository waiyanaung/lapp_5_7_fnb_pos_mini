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
use App\Setup\Item\ItemRepositoryInterface;
use App\Setup\Country\CountryRepository;
use App\Setup\Category\CategoryRepository;
use App\Setup\Brand\BrandRepository;

class ItemDetailController extends Controller
{

    public function __construct(ItemRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index($id)
    {
        // $obj = array(
        //     array(
        //       "name" => "Shop 1",
        //       "phone" => "09 123456789",
        //       "address" => "This is the address of shop 1"
        //     )
		//   );
		
		$categoryRepo       = new CategoryRepository();
        $categories         = $categoryRepo->getObjs();        

        $countryRepo = new CountryRepository();
        $countries = $countryRepo->getObjs();

        $brand_repo = new BrandRepository();
        $brands = $brand_repo->getObjs();
		
		$selected_brand_name	= "";
		$selected_category_name = "";

		$obj          	= $this->repo->getObjByID($id);
		if(isset($obj) && count(array($obj))>0){

			
			$selected_brand = $brand_repo->getObjByID($obj->brand_id);
			if (isset($selected_brand)) {
				$selected_brand_name	= $selected_brand->name . " brand";
			}
			
			$selectedCategory = $categoryRepo->getObjByID($obj->category_id);
			if (isset($selectedCategory)) {
				$selected_category_name	= $selectedCategory->name . " category";
			}

			return view('frontend.item_detail')
				->with('obj',$obj)
				->with('countries',$countries)
				->with('brands', $brands)				
				->with('categories', $categories)
				->with('selected_category_name',$selected_category_name)
				->with('selected_brand_name', $selected_brand_name);

		}
		else{
			$obj          	= $this->repo->getObjs();

			return view('frontend.item')
			->with('countries',$countries)
			->with('brands', $brands)			
			->with('categories', $categories)
			->with('selected_category_name',$selected_category_name)
			->with('selected_brand_name', $selected_brand_name);
		}
    }

}
