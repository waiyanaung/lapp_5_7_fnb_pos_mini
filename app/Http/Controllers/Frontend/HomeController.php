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
use App\Setup\Slider\SliderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Setup\Brand\BrandRepository;

class HomeController extends Controller
{

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        //Get Slider For Home Page
        $sliderRepo = new SliderRepository();
		$sliders = $sliderRepo->getObjs();
		
		$brand_repo = new BrandRepository();
		$brands = $brand_repo->getObjs();

        //check for language, if jp, show jp title and description
        foreach ($sliders as $slider) {
            if (Session::has('locale') && Session::get('locale') == "jp") {
                $slider->title = $slider->title_jp;
                $slider->description = $slider->description_jp;
            }
        }

		foreach ($brands as $brand) {
            if (Session::has('locale') && Session::get('locale') == "jp") {
                $brand->title = $brand->title_jp;
                $brand->description = $brand->description_jp;
            }
		}
		
        //flag for first slider image(to be active)
		$first_slider = 1;
		$first_brand = 1;
        return view('frontend.home')
			->with('first_slider', $first_slider)
			->with('first_brand', $first_brand)
			->with('brands', $brands)
            ->with('sliders', $sliders);
    }

    public function index2(Request $request)
    {
        //Get Slider For Home Page
        $template_id = 1; //1 For Home Page
        $sliderRepo = new SliderRepository();
        $sliders = $sliderRepo->getObjs();

        //check for language, if jp, show jp title and description
        foreach ($sliders as $slider) {
            if (Session::has('locale') && Session::get('locale') == "jp") {
                $slider->title = $slider->title_jp;
                $slider->description = $slider->description_jp;
            }
        }

        //flag for first slider image(to be active)
        $first_slider = 1;

        return view('frontend.home')
            ->with('first_slider', $first_slider)
            ->with('sliders', $sliders);
    }

    public function autocompleteDestination()
    {
        $autocompleteRepo = new AutocompleteRepository();
        $results = $autocompleteRepo->getDestinations();
        //sort array values alphabetically
        sort($results);
        return \Response::json($results);
    }

    public function test()
    {
        return view('frontend.test');
    }

    public function aboutus()
    {
        return view('frontend.aboutus');
    }

    public function comingsoon(Request $request)
    {
        return view('frontend.comingsoon');
    }

}
