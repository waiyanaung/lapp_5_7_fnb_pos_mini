<?php

namespace App\Http\Controllers\Setup\Page;

use App\Backend\Infrastructure\Forms\PageEditRequest;
use App\Backend\Infrastructure\Forms\PageEntryRequest;
use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\Setup\Page\PageRepositoryInterface;
use App\Setup\Page\PageRepository;
use App\Setup\Page\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;

class PageController extends Controller
{
    private $repo;

    public function __construct(PageRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
         if(Auth::check()) {
             $pages          = $this->repo->getObjs();
             return view('backend.page.index')->with('pages',$pages);
         }
         return redirect('/');
    }

    public function edit($id)
    {
        if(Auth::check()) {
            $page       = $this->repo->getObjByID($id);

            return view('backend.page.page')
                ->with('page',$page);
        }
        return redirect('/backend_app/login');
    }

    public function update(PageEditRequest $request)
    {
        $validated = $request->validated();
        $id                     = Input::get('id');
        $page_name              = Input::get('page_name');
        $content                = Input::get('content');

        $paramObj               = $this->repo->getObjByID($id);
        $paramObj->name         = $page_name;
        $paramObj->content      = $content;

        $result = $this->repo->update($paramObj);

        if($result['laravelStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Setup\Page\PageController@index')
                ->with(FormatGenerator::message('Success', 'Page is updated ...'));
        }
        else{
            return redirect()->action('Setup\Page\PageController@index')
                ->with(FormatGenerator::message('Fail', 'Page is not updated ...'));
        }

    }

    public function upload(Request $request) {

    }
}
