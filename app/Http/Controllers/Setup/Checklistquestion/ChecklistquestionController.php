<?php

namespace App\Http\Controllers\Setup\Checklistquestion;

use App\Core\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ChecklistquestionEntryRequest;
use App\Backend\Infrastructure\Forms\ChecklistquestionEditRequest;
use App\Setup\Checklistquestion\ChecklistquestionRepositoryInterface;
use App\Setup\Checklistquestion\Checklistquestion;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class ChecklistquestionController extends Controller
{
    private $repo;

    public function __construct(ChecklistquestionRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            //$checklistquestions      = $this->repo->getObjs();
            $checklistquestions      = array(
                array(
                    "id" => 1,
                  "name" => "Checklistquestion 1",
                  "code" => "001",
                  "description" => "This is the Checklistquestion 1"
                ),
                array(
                    "id" => 2,
                  "name" => "Checklistquestion 2",
                  "code" => "002",
                  "description" => "This is the Checklistquestion 2"
                  ),
                  array(
                    "id" => 3,
                  "name" => "Checklistquestion 3",
                  "code" => "003",
                  "description" => "This is the Checklistquestion 3"
                  ),
                  array(
                    "id" => 4,
                  "name" => "Checklistquestion 4",
                  "code" => "004",
                  "description" => "This is the Checklistquestion 4"
                   )
              );
            return view('backend.checklistquestion.index')->with('checklistquestions',$checklistquestions);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {            
            return view('backend.checklistquestion.checklistquestion');
        }
        return redirect('/');
    }

    public function store(ChecklistquestionEntryRequest $request)
    {
        

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $checklistquestion        = Checklistquestion::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjs();

            return view('backend.checklistquestion.checklistquestion')->with('checklistquestion', $checklistquestion)->with('countries', $countries);
        }
        return redirect('/backend_app/login');
    }

    public function update(ChecklistquestionEditRequest $request){
        
    }

    public function destroy(){

        
    }

}
