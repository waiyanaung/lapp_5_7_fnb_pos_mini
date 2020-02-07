<?php

namespace App\Http\Controllers\Setup\Checklistupload;

use App\Core\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ChecklistuploadEntryRequest;
use App\Backend\Infrastructure\Forms\ChecklistuploadEditRequest;
use App\Setup\Checklistupload\ChecklistuploadRepositoryInterface;
use App\Setup\Checklistupload\Checklistupload;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class ChecklistuploadController extends Controller
{
    private $repo;
    public $checklistuploads = array();

    public function __construct(ChecklistuploadRepositoryInterface $repo)
    {
        $this->repo = $repo;
        
    }

    public function index(Request $request)
    {

        // Checklist Upload Status
        // 1 = Submitted
        // 2 = Submitted_Reject
        // 3 = Inspected
        // 4 = Inspected_Reject
        // 5 = Verified
        // 6 = Verified_Reject       

        if(Auth::check()) {
            //$checklistuploads      = $this->repo->getObjs();
            $user_info      = \App\Core\Check::getInfo();
            $user_roleId = $user_info['userRoleId'];
            $this->dataApply($user_roleId);
            $checklistuploads      =  $this->checklistuploads;

            return view('backend.checklistupload.index')->with('checklistuploads',$checklistuploads);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            $user_info      = \App\Core\Check::getInfo();
            $user_roleId = $user_info['userRoleId'];
            $this->dataApply($user_roleId);
            $checklistuploads      =  $this->checklistuploads;

            return view('backend.checklistupload.checklistupload');
        }
        return redirect('/');
    }

    public function store(ChecklistuploadEntryRequest $request)
    {
        

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $user_info      = \App\Core\Check::getInfo();
            $user_roleId = $user_info['userRoleId'];
            $this->dataApply($user_roleId);
            $checklistuploads      =  $this->checklistuploads;

            //$checklistupload        = Checklistupload::find($id);
            $checklistupload =  $checklistuploads[$id - 1];
            return view('backend.checklistupload.checklistupload')->with('checklistupload', $checklistupload);
        }
        return redirect('/backend_app/login');
    }

    public function update(ChecklistuploadEditRequest $request){
        
    }

    public function destroy(){

        
    }

    public function dataApply($roleId)
    {
        if($roleId == 1 || $roleId == 2 || $roleId == 3 ){
            $this->checklistuploads      = array(
                array(
                    "id" => 1,
                    "name" => "Checklist 1",
                    "document_code" => "Q-001",
                    "project_name" => "Project 1",
                    "status" => "1",
                    "status_string" => "Submitted",
                    "submitted_by" => "U Mg Mg",
                    "inspected_by" => "",
                    "verified_by" => "",
                    "description" => "This is the checklist 1",
                ),
                array(
                    "id" => 2,
                    "name" => "Checklist 2",
                    "document_code" => "Q-002",
                    "project_name" => "Project 2",
                    "status" => "3",
                    "status_string" => "Inspected",
                    "submitted_by" => "U Kyaw Kyaw",
                    "inspected_by" => "U Aung Aung",
                    "verified_by" => "",
                    "description" => "This is the checklist 2",
                ),
                array(
                    "id" => 3,
                    "name" => "Checklist 3",
                    "document_code" => "Q-003",
                    "project_name" => "Project 3",
                    "status" => "5",
                    "status_string" => "Verified",
                    "submitted_by" => "U Zaw Zaw",
                    "inspected_by" => "U Kyaw Kyaw",
                    "verified_by" => "U Nyi Nyi",
                    "description" => "This is the checklist 4",
                ),
                array(
                    "id" => 4,
                    "name" => "Checklist 4",
                    "document_code" => "Q-004",
                    "project_name" => "Project 4",
                    "status" => "5",
                    "status_string" => "Verified",
                    "submitted_by" => "U Mg Mya",
                    "inspected_by" => "U Kyaw Kyaw",
                    "verified_by" => "U Nyi Nyi",
                    "description" => "This is the checklist 4",
                ),
          );
        }
        else if($roleId == 4 ){

            $this->checklistuploads      = array(
                array(
                    "id" => 1,
                    "name" => "Checklist 1",
                    "document_code" => "Q-001",
                    "project_name" => "Project 1",
                    "status" => "1",
                    "status_string" => "Submitted",
                    "submitted_by" => "U Mg Mg",
                    "inspected_by" => "",
                    "verified_by" => "",
                    "description" => "This is the checklist 1",
                ),
                array(
                    "id" => 2,
                    "name" => "Checklist 2",
                    "document_code" => "Q-002",
                    "project_name" => "Project 2",
                    "status" => "3",
                    "status_string" => "Inspected",
                    "submitted_by" => "U Kyaw Kyaw",
                    "inspected_by" => "U Aung Aung",
                    "verified_by" => "",
                    "description" => "This is the checklist 2",
                ),
                array(
                    "id" => 3,
                    "name" => "Checklist 3",
                    "document_code" => "Q-003",
                    "project_name" => "Project 3",
                    "status" => "5",
                    "status_string" => "Verified",
                    "submitted_by" => "U Zaw Zaw",
                    "inspected_by" => "U Kyaw Kyaw",
                    "verified_by" => "U Nyi Nyi",
                    "description" => "This is the checklist 4",
                )
            );

        }
        else{

            $this->checklistuploads      = array(
                array(
                    "id" => 1,
                    "name" => "Checklist 1",
                    "document_code" => "Q-001",
                    "project_name" => "Project 1",
                    "status" => "1",
                    "status_string" => "Submitted",
                    "submitted_by" => "U Mg Mg",
                    "inspected_by" => "",
                    "verified_by" => "",
                    "description" => "This is the checklist 1",
                ),
                array(
                    "id" => 2,
                    "name" => "Checklist 2",
                    "document_code" => "Q-002",
                    "project_name" => "Project 2",
                    "status" => "1",
                    "status_string" => "Submitted",
                    "submitted_by" => "U Mg Mg",
                    "inspected_by" => "",
                    "verified_by" => "",
                    "description" => "This is the checklist 2",
                ),
                array(
                    "id" => 3,
                    "name" => "Checklist 4",
                    "document_code" => "Q-004",
                    "project_name" => "Project 4",
                    "status" => "5",
                    "status_string" => "Verified",
                    "submitted_by" => "U Mg Mg",
                    "inspected_by" => "U Kyaw Kyaw",
                    "verified_by" => "U Nyi Nyi",
                    "description" => "This is the checklist 4",
                ),
            );

        }
    }

}
