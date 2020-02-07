<?php

namespace App\Http\Controllers\Setup\Document;

use App\Core\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\DocumentEntryRequest;
use App\Backend\Infrastructure\Forms\DocumentEditRequest;
use App\Setup\Document\DocumentRepositoryInterface;
use App\Setup\Document\Document;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class DocumentController extends Controller
{
    private $repo;

    public function __construct(DocumentRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            //$documents      = $this->repo->getObjs();
            $documents      = array(
                array(
                    "id" => 1,
                  "name" => "Document 1",
                  "code" => "001",
                  "description" => "This is the Document 1"
                ),
                array(
                    "id" => 2,
                  "name" => "Document 2",
                  "code" => "002",
                  "description" => "This is the Document 2"
                  ),
                  array(
                    "id" => 3,
                  "name" => "Document 3",
                  "code" => "003",
                  "description" => "This is the Document 3"
                  ),
                  array(
                    "id" => 4,
                  "name" => "Document 4",
                  "code" => "004",
                  "description" => "This is the Document 4"
                   )
              );
            return view('backend.document.index')->with('documents',$documents);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {            
            return view('backend.document.document');
        }
        return redirect('/');
    }

    public function store(DocumentEntryRequest $request)
    {
        

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $document        = Document::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjs();

            return view('backend.document.document')->with('document', $document)->with('countries', $countries);
        }
        return redirect('/backend_app/login');
    }

    public function update(DocumentEditRequest $request){
        
    }

    public function destroy(){

        
    }

}
