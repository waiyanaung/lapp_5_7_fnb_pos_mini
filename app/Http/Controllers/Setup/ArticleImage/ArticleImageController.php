<?php

namespace App\Http\Controllers\Setup\ArticleImage;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ArticleImageEntryRequest;
use App\Backend\Infrastructure\Forms\ArticleImageEditRequest;
use App\Setup\ArticleImage\ArticleImageRepositoryInterface;
use App\Setup\ArticleImage\ArticleImage;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use image;

class ArticleImageController extends Controller
{
    private $repo;

    public function __construct(ArticleImageRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $articles      = $this->repo->getObjs();
            return view('backend.article.index')->with('articles',$articles);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.article.article');
        }
        return redirect('/');
    }

    public function store(ArticleImageEntryRequest $request)
    {
        $validated              = $request->validated();
        $article_name           = Input::get('name');
        $code                   = Input::get('code');
        $image_url_name         = "";
        $detail_info             = Input::get('detail_info');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/article/';

        if(Input::hasFile('image_url'))
        {
            $image_url        = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext      = Utility::getImageExt($image_url);
            $image_url_name     = uniqid() . "." . $image_url_ext;
            $image          = Utility::resizeImage($image_url,$image_url_name,$path);
        }
        else{
            $image_url_name = "";
        }

        if($removeImageFlag == 1){
            $image_url_name = "";
        }
        //End Saving Image

        $paramObj = new ArticleImage();
        $paramObj->name         = $article_name;
        $paramObj->code         = $code;
        $paramObj->image_url    = '/images/article/' . $image_url_name;
        $paramObj->detail_info  = $detail_info;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\ArticleImage\ArticleImageController@index')
                ->with(FormatGenerator::message('Success', 'ArticleImage is created ...'));
        }
        else{
            return redirect()->action('Setup\ArticleImage\ArticleImageController@index')
                ->with(FormatGenerator::message('Fail', 'ArticleImage is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $article        = ArticleImage::find($id);
            return view('backend.article.article')->with('obj', $article);
        }
        return redirect('/backend_app/login');
    }

    public function update(ArticleImageEditRequest $request){
        
        $validated = $request->validated();
        $id                         = Input::get('id');
        $article_name               = Input::get('name');
        $code                       = Input::get('code');
        $detail_info                = Input::get('detail_info');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/article/';
        
        if(Input::hasFile('image_url'))
        {   
            $image_url        = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext      = Utility::getImageExt($image_url);
            $image_url_name     = uniqid() . "." . $image_url_ext;
            $image          = Utility::resizeImage($image_url,$image_url_name,$path);
        }
        else{            
            $image_url_name = "";
        }

        if($removeImageFlag == 1){
            $image_url_name = "";
        }
        //End Saving Image

        $paramObj                   = ArticleImage::find($id);
        $paramObj->name             = $article_name;
        $paramObj->code             = $code;
        $paramObj->detail_info      = $detail_info;
        $paramObj->image_url        = '/images/article/' . $image_url_name;

        if(Input::hasFile('image_url')){
            $paramObj->image_url                 = '/images/article/' . $image_url_name;
        }
        else{
            if($removeImageFlag == 1){
                $paramObj->image_url             = "";
            }
        }

        $result = $this->repo->update($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\ArticleImage\ArticleImageController@index')
                ->with(FormatGenerator::message('Success', 'ArticleImage is updated ...'));
        }
        else{

            return redirect()->action('Setup\ArticleImage\ArticleImageController@index')
                ->with(FormatGenerator::message('Fail', 'ArticleImage is not updated ...'));
        }
    }

    public function destroy(){
            
        
    }

    public function check_article_name(){
        $article_name     = Input::get('article_name');
        $country_id    = Input::get('country_id');
        $article          = ArticleImage::where('country_id','=',$country_id)->where('article_name','=',$article_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($article) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
