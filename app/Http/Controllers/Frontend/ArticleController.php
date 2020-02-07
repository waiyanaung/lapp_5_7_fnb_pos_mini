<?php
/**
 * Created by Visual Studio Code.
 * User: william
 * Author: Wai Yan Aung
 * Date: 1/14/2019
 * Time: 10:55 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Setup\Page\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Redirect;
use Illuminate\Support\Facades\Session;

use App\Setup\Article\ArticleRepositoryInterface;
use App\Setup\Article\Article;

class ArticleController extends Controller
{

    public function __construct(ArticleRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        
        $objs = array();
        $objs      = $this->repo->getObjs();
        return view('frontend.article')->with('objs',$objs);
    }

    public function article_detail($id)
    {
        try{
            $obj  = Article::find($id);
            if (isset($obj) && count(array($obj))>0) {
                return view('frontend.article_detail')
                        ->with('obj', $obj);
            }
            else{
                $objs = array();
                $objs      = $this->repo->getObjs();
                return view('frontend.article')->with('objs',$objs);
            }
        }
        catch(Exception $ex){
            return view('/');
        }
        
    }

}
