<?php

namespace App\Http\Controllers\Setup\Product;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ProductEntryRequest;
use App\Backend\Infrastructure\Forms\ProductEditRequest;
use App\Setup\Product\ProductRepositoryInterface;
use App\Setup\Product\Product;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class ProductController extends Controller
{
    private $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $products      = $this->repo->getObjs();
            return view('backend.product.index')->with('products',$products);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            $countryRepo = new CountryRepository();
            $countries = $countryRepo->getObjs();
            return view('backend.product.product')->with('countries',$countries);
        }
        return redirect('/');
    }

    public function store(ProductEntryRequest $request)
    {
        $validated = $request->validated();
        $product_name       = Input::get('name');
        $country_id      = Input::get('country_id');
        $code            = Input::get('code');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/upload/';

        if(Input::hasFile('photo'))
        {
            $photo        = Input::file('photo');
            $photo_name_original    = Utility::getImage($photo);
            $photo_ext      = Utility::getImageExt($photo);
            $photo_name     = uniqid() . "." . $photo_ext;
            $image          = Utility::resizeImage($photo,$photo_name,$path);
        }
        else{
            $photo_name = "";
        }

        if($removeImageFlag == 1){
            $photo_name = "";
        }
        //End Saving Image

        $paramObj = new Product();
        $paramObj->name         = $product_name;
        $paramObj->country_id   = $country_id;
        $paramObj->code         = $code;
        $paramObj->image        = $photo_name;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Product\ProductController@index')
                ->with(FormatGenerator::message('Success', 'Product is created ...'));
        }
        else{
            return redirect()->action('Setup\Product\ProductController@index')
                ->with(FormatGenerator::message('Fail', 'Product is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $product        = Product::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjs();

            return view('backend.product.product')->with('product', $product)->with('countries', $countries);
        }
        return redirect('/backend_app/login');
    }

    public function update(ProductEditRequest $request){

        $validated = $request->validated();
        $id                         = Input::get('id');
        $product_name                  = Input::get('name');
        $country_id                 = Input::get('country_id');
        $code                       = Input::get('code');
        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/upload/';

        if(Input::hasFile('photo'))
        {
            $photo        = Input::file('photo');
            $photo_name_original    = Utility::getImage($photo);
            $photo_ext      = Utility::getImageExt($photo);
            $photo_name     = uniqid() . "." . $photo_ext;
            $image          = Utility::resizeImage($photo,$photo_name,$path);
        }
        else{
            $photo_name = "";
        }

        if($removeImageFlag == 1){
            $photo_name = "";
        }
        //End Saving Image

        $paramObj                   = Product::find($id);
        $paramObj->name             = $product_name;
        $paramObj->country_id       = $country_id;
        $paramObj->code             = $code;
        if(Input::hasFile('photo')){
            $paramObj->image                 = $photo_name;
        }
        else{
            if($removeImageFlag == 1){
                $paramObj->image             = "";
            }
        }

        $result = $this->repo->update($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Product\ProductController@index')
                ->with(FormatGenerator::message('Success', 'Product is updated ...'));
        }
        else{

            return redirect()->action('Setup\Product\ProductController@index')
                ->with(FormatGenerator::message('Fail', 'Product is not updated ...'));
        }
    }

    public function destroy(){

        
    }

    public function check_product_name(){
        $product_name     = Input::get('product_name');
        $country_id    = Input::get('country_id');
        $product          = Product::where('country_id','=',$country_id)->where('product_name','=',$product_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($product) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
