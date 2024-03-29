<?php

namespace App\Http\Controllers\Setup\Item;

use App\Backend\Infrastructure\Forms\ItemEditRequest;
use App\Backend\Infrastructure\Forms\ItemEntryRequest;
use App\Core\Check;
use App\Core\FormatGenerator as FormatGenerator;
use App\Core\ReturnMessage as ReturnMessage;
use App\Core\Utility;
use App\Http\Controllers\Controller;
use App\Setup\Category\CategoryRepository;
use App\Setup\Item\Item;
use App\Setup\Item\ItemRepositoryInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Setup\Country\CountryRepository;
use App\Setup\Brand\BrandRepository;

class ItemController extends Controller
{
    private $repo;

    public function __construct(ItemRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
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

    public function create()
    {
        if (Auth::check()) {
            $categoryRepo = new CategoryRepository();
            $categories = $categoryRepo->getObjs();

            $countryRepo = new CountryRepository();
            $countries = $countryRepo->getObjs();

            $brand_repo = new BrandRepository();
            $brands = $brand_repo->getObjs();

            return view('backend.item.item')
                ->with('countries',$countries)
                ->with('brands', $brands)                
                ->with('categories', $categories);
        }
        return redirect('/');
    }

    public function store(ItemEntryRequest $request)
    {
        try{
            $validated = $request->validated();
            $name = Input::get('name');
            $status = Input::get('status');
            $code = Input::get('code');
            $price = Input::get('price');
            $model = Input::get('model');
            $category_id = Input::get('category_id');
            $brand_id = Input::get('brand_id');
            $country_id = Input::get('country_id');
            $description = Input::get('description');
            $detail_info = Input::get('detail_info');        
            $remark = Input::get('remark');            
            $custom_features = Input::get('custom_features');            

            $image_url_name = "";
            //Start Saving Image
            $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
            $path = base_path() . '/public/images/item/';

            if (Input::hasFile('image_url')) {
                $image_url = Input::file('image_url');
                $image_url_name_original = Utility::getImage($image_url);
                $image_url_ext = Utility::getImageExt($image_url);
                $image_url_name = uniqid() . "." . $image_url_ext;
                $image = Utility::resizeImage($image_url, $image_url_name, $path);
            } else {
                $image_url_name = "";
            }

            if ($removeImageFlag == 1) {
                $image_url_name = "";
            }
            //End Saving Image 1

            //Start Saving Image
            $removeImageFlag1 = (Input::has('removeImageFlag1')) ? Input::get('removeImageFlag1') : 0;
            $path1 = base_path() . '/public/images/item/';

            if (Input::hasFile('image_url1')) {
                $image_url1 = Input::file('image_url1');
                $image_url_name_original1 = Utility::getImage($image_url1);
                $image_url_ext1 = Utility::getImageExt($image_url1);
                $image_url_name1 = uniqid() . "." . $image_url_ext1;
                $image1 = Utility::resizeImage($image_url1, $image_url_name1, $path1);
            } else {
                $image_url_name1 = "";
            }

            if ($removeImageFlag1 == 1) {
                $image_url_name1 = "";
            }
            //End Saving Image 1

            $paramObj = new Item();

            $paramObj->name = $name;
            $paramObj->code = $code;
            $paramObj->price = $price;
            $paramObj->model = $model;
            $paramObj->status = $status;
            $paramObj->category_id = $category_id;
            $paramObj->brand_id = $brand_id;
            $paramObj->country_id = $country_id;
            $paramObj->description = $description;
            $paramObj->detail_info = $detail_info;
            $paramObj->remark = $remark;            
            $paramObj->custom_features = $custom_features;
            
            $paramObj->image_url = '/images/item/' . $image_url_name;
            $paramObj->image_url1 = '/images/item/' . $image_url_name1;        

            $result = $this->repo->create($paramObj);
            if ($result['laravelStatusCode'] == ReturnMessage::OK) {

                return redirect()->action('Setup\Item\ItemController@index')
                    ->with(FormatGenerator::message('Success', 'Item is created ...'));
            } else {
               
                return redirect()->action('Setup\Item\ItemController@index')
                    ->with(FormatGenerator::message('Fail', 'Item is not created ...'));
            }
        }
        catch(Exception $e){
            return redirect()->action('Setup\Item\ItemController@index')
                    ->with(FormatGenerator::message('Fail', 'There is an unexpected error while creating item. Please connect to Site Admin and sorry for error ... '));
        }

    }

    public function edit($id)
    {
        if (Auth::check()) {
            $item = Item::find($id);
            $categoryRepo = new CategoryRepository();
            $categories = $categoryRepo->getObjs();

            $countryRepo = new CountryRepository();
            $countries = $countryRepo->getObjs();

            $brand_repo = new BrandRepository();
            $brands = $brand_repo->getObjs();

            return view('backend.item.item')
                ->with('obj', $item)
                ->with('countries',$countries)
                ->with('brands', $brands)                
                ->with('categories', $categories);
        }
        return redirect('/backend_app/login');
    }

    public function update(ItemEditRequest $request)
    {
        $validated = $request->validated();
        $id = Input::get('id');
        $name = Input::get('name');
        $code = Input::get('code');
        $price = Input::get('price');
        $model = Input::get('model');
        $category_id = Input::get('category_id');
        $brand_id = Input::get('brand_id');
        $country_id = Input::get('country_id');
        $description = Input::get('description');
        $detail_info = Input::get('detail_info');
        $status = Input::get('status');
        $remark = Input::get('remark');        
        $custom_features = Input::get('custom_features');

        $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path = base_path() . '/public/images/item/';
        $remove_old_image = false;

        $removeImageFlag1 = (Input::has('removeImageFlag1')) ? Input::get('removeImageFlag1') : 0;
        $path1 = base_path() . '/public/images/item/';
        $remove_old_image1 = false;

        $paramObj = Item::find($id);
        $old_image = $paramObj->image_url;
        $old_image1 = $paramObj->image_url1;
        
        $paramObj->name = $name;
        $paramObj->code = $code;
        $paramObj->price = $price;
        $paramObj->model = $model;
        $paramObj->status = $status;
        $paramObj->category_id = $category_id;
        $paramObj->brand_id = $brand_id;
        $paramObj->country_id = $country_id;
        $paramObj->description = $description;
        $paramObj->detail_info = $detail_info;
        $paramObj->remark = $remark;
        $paramObj->custom_features = $custom_features;        
       
        if (Input::hasFile('image_url')) {
            //Start Saving Image
            $image_url = Input::file('image_url');
            $image_url_name_original = Utility::getImage($image_url);
            $image_url_ext = Utility::getImageExt($image_url);
            $image_url_name = uniqid() . "." . $image_url_ext;
            $image = Utility::resizeImage($image_url, $image_url_name, $path);
            $remove_old_image = true;
            $paramObj->image_url = '/images/item/' . $image_url_name;
            //End Saving Image
        } else {
            if ($removeImageFlag == 1) {
                $paramObj->image_url = "";
                $remove_old_image = true;
            }
        }

        if (Input::hasFile('image_url1')) {
            //Start Saving Image 1
            $image_url1 = Input::file('image_url1');
            $image_url_name_original1 = Utility::getImage($image_url1);
            $image_url_ext1 = Utility::getImageExt($image_url1);
            $image_url_name1 = uniqid() . "." . $image_url_ext1;
            $image1 = Utility::resizeImage($image_url1, $image_url_name1, $path1);
            $remove_old_image1 = true;
            $paramObj->image_url1 = '/images/item/' . $image_url_name1;
            //End Saving Image 1
        } else {
            if ($removeImageFlag1 == 1) {
                $paramObj->image_url1 = "";
                $remove_old_image1 = true;
            }
        }
            
        $result = $this->repo->update($paramObj);
        if ($result['laravelStatusCode'] == ReturnMessage::OK) {

            // Delete the old image
            if ($remove_old_image == true) {
                Utility::removeImage($old_image);
            }

            // Delete the old image 1
            if ($remove_old_image1 == true) {
                Utility::removeImage($old_image1);
            }

            return redirect()->action('Setup\Item\ItemController@index')
                ->with(FormatGenerator::message('Success', 'Item is updated ...'));
        } else {

            return redirect()->action('Setup\Item\ItemController@index')
                ->with(FormatGenerator::message('Fail', 'Item is not updated ...'));
        }
    }

    public function destroy()
    {
        $id = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach ($new_string as $id) {
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Item\ItemController@index')
            ->with(FormatGenerator::message('Success', 'de-activated successfully   ...'));
    }

    public function enable()
    {
        $id = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach ($new_string as $id) {
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Item\ItemController@index')
            ->with(FormatGenerator::message('Success', 'activated successfully   ...'));
    }

    public function check_item_name()
    {
        $item_name = Input::get('item_name');
        $country_id = Input::get('country_id');
        $item = Item::where('country_id', '=', $country_id)->where('item_name', '=', $item_name)->whereNull('deleted_at')->get();
        $result = false;
        if (count($item) == 0) {
            $result = true;
        }

        return \Response::json($result);
    }

}
