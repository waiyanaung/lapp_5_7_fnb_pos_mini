<?php

namespace App\Http\Controllers\Setup\Project;

use App\Core\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ProjectEntryRequest;
use App\Backend\Infrastructure\Forms\ProjectEditRequest;
use App\Setup\Project\ProjectRepositoryInterface;
use App\Setup\Project\Project;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class ProjectController extends Controller
{
    private $repo;

    public function __construct(ProjectRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            //$projects      = $this->repo->getObjs();
            $projects      = array(
                array(
                    "id" => 1,
                  "name" => "Project 1",
                  "code" => "001",
                  "description" => "This is the Project 1"
                ),
                array(
                    "id" => 2,
                  "name" => "Project 2",
                  "code" => "002",
                  "description" => "This is the Project 2"
                  ),
                  array(
                    "id" => 3,
                  "name" => "Project 3",
                  "code" => "003",
                  "description" => "This is the Project 3"
                  ),
                  array(
                    "id" => 4,
                  "name" => "Project 4",
                  "code" => "004",
                  "description" => "This is the Project 4"
                   )
              );
            return view('backend.project.index')->with('projects',$projects);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {            
            return view('backend.project.project');
        }
        return redirect('/');
    }

    public function store(ProjectEntryRequest $request)
    {
        

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $project        = Project::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjs();

            return view('backend.project.project')->with('project', $project)->with('countries', $countries);
        }
        return redirect('/backend_app/login');
    }

    public function update(ProjectEditRequest $request){
        
    }

    public function destroy(){

        
    }

}
