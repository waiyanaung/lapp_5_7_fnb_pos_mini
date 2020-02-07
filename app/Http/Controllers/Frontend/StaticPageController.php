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
use App\Http\Requests;

use App\Setup\Page\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Redirect;

class StaticPageController extends Controller
{

    public function __construct()
    {
    }

    public function transportations(Request $request)
    {
        $id           = 2;
        $page_data    = Page::find($id)->first();
        //start transportations page
        return view('frontend.static_page')->with('page_data',$page_data);
    }

    public function airtickets(Request $request)
    {
        $id           = 1;
        $page_data    = Page::find($id)->first();
        //start transportations page
        return view('frontend.static_page')->with('page_data',$page_data);
    }

}
