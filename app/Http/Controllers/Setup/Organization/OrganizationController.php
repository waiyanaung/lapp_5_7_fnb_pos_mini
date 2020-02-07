<?php

namespace App\Http\Controllers\Setup\Organization;

use App\Core\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\OrganizationEntryRequest;
use App\Backend\Infrastructure\Forms\OrganizationEditRequest;
use App\Setup\Organization\OrganizationRepositoryInterface;
use App\Setup\Organization\Organization;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class OrganizationController extends Controller
{
    private $repo;

    public function __construct(OrganizationRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            //$organizations      = $this->repo->getObjs();
            $organizations      = array(
                array(
                    "id" => 1,
                  "name" => "Organization 1",
                  "code" => "001",
                  "description" => "This is the Organization 1"
                ),
                array(
                    "id" => 2,
                  "name" => "Organization 2",
                  "code" => "002",
                  "description" => "This is the Organization 2"
                  ),
                  array(
                    "id" => 3,
                  "name" => "Organization 3",
                  "code" => "003",
                  "description" => "This is the Organization 3"
                  ),
                  array(
                    "id" => 4,
                  "name" => "Organization 4",
                  "code" => "004",
                  "description" => "This is the Organization 4"
                   )
              );
            return view('backend.organization.index')->with('organizations',$organizations);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {            
            return view('backend.organization.organization');
        }
        return redirect('/');
    }

    public function store(OrganizationEntryRequest $request)
    {
        

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $organization        = Organization::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjs();

            return view('backend.organization.organization')->with('organization', $organization)->with('countries', $countries);
        }
        return redirect('/backend_app/login');
    }

    public function update(OrganizationEditRequest $request){
        
    }

    public function destroy(){

        
    }

}
