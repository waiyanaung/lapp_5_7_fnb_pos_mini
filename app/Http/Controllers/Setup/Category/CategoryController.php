<?php

namespace App\Http\Controllers\Setup\Category;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\CategoryEntryRequest;
use App\Backend\Infrastructure\Forms\CategoryEditRequest;
use App\Setup\Category\CategoryRepositoryInterface;
use App\Setup\Category\Category;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use image;

class CategoryController extends Controller
{
    private $repo;

    public function __construct(CategoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $categories      = $this->repo->getObjsAll();
            return view('backend.category.index')->with('categories',$categories);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.category.category');
        }
        return redirect('/');
    }

    public function store(CategoryEntryRequest $request)
    {
        $validated                      = $request->validated();
        $category_name                  = Input::get('name');
        $code                           = Input::get('code');
        $image_name                     = "";
        $detail_info                    = Input::get('detail_info');
        $status                         = Input::get('status');

        //Start Saving Image
        $removeImageFlag                = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                           = base_path().'/public/images/category/';

        if(Input::hasFile('image'))
        {
            $image        = Input::file('image');
            $image_name_original    = Utility::getImage($image);
            $image_ext      = Utility::getImageExt($image);
            $image_name     = uniqid() . "." . $image_ext;
            $image          = Utility::resizeImage($image,$image_name,$path);
        }
        else{
            $image_name = "";
        }

        if($removeImageFlag == 1){
            $image_name = "";
        }
        //End Saving Image

        $paramObj = new Category();
        $paramObj->name         = $category_name;
        $paramObj->code         = $code;
        $paramObj->image    = '/images/category/' . $image_name;
        $paramObj->detail_info  = $detail_info;
        $paramObj->status       = $status;
       
        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Category\CategoryController@index')
                ->with(FormatGenerator::message('Success', 'Category is created ...'));
        }
        else{
            return redirect()->action('Setup\Category\CategoryController@index')
                ->with(FormatGenerator::message('Fail', 'Category is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $category        = Category::find($id);
            return view('backend.category.category')->with('obj', $category);
        }
        return redirect('/backend_app/login');
    }

    public function update(CategoryEditRequest $request){
        
        $validated                      = $request->validated();
        $id                             = Input::get('id');
        $category_name                    = Input::get('name');
        $code                           = Input::get('code');
        $detail_info                    = Input::get('detail_info');
        $status                         = Input::get('status');
        
        $removeImageFlag                = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                           = base_path().'/public/images/category/';        
        $remove_old_image               = false;

        $paramObj                       = Category::find($id);
        $old_image                      = $paramObj->image;
        $paramObj->name                 = $category_name;
        $paramObj->code                 = $code;
        $paramObj->detail_info          = $detail_info;
        $paramObj->status               = $status;

        if(Input::hasFile('image'))
        {   
            //Start Saving Image
            $image                  = Input::file('image');
            $image_name_original    = Utility::getImage($image);
            $image_ext              = Utility::getImageExt($image);
            $image_name             = uniqid() . "." . $image_ext;
            $image                      = Utility::resizeImage($image,$image_name,$path);
            $remove_old_image           = true;
            $paramObj->image        = '/images/category/' . $image_name;
            //End Saving Image
        }
        else{
            if($removeImageFlag == 1){
                $paramObj->image    = "";
                $remove_old_image       = true;
            }
        }

        $result = $this->repo->update($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            // Delete the old image
            if($remove_old_image           == true){
                Utility::removeImage($old_image);
            }            

            return redirect()->action('Setup\Category\CategoryController@index')
                ->with(FormatGenerator::message('Success', 'Category is updated ...'));
        }
        else{

            return redirect()->action('Setup\Category\CategoryController@index')
                ->with(FormatGenerator::message('Fail', 'Category is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Category\CategoryController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Category\CategoryController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function check_category_name(){
        $category_name     = Input::get('category_name');
        $country_id    = Input::get('country_id');
        $category          = Category::where('country_id','=',$country_id)->where('category_name','=',$category_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($category) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
