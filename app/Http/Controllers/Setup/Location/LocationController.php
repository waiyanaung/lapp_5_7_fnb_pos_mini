<?php

namespace App\Http\Controllers\Setup\Location;

use App\Core\Utility;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\LocationEntryRequest;
use App\Backend\Infrastructure\Forms\LocationEditRequest;
use App\Setup\Location\LocationRepositoryInterface;
use App\Setup\Location\Location;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

class LocationController extends Controller
{
    private $repo;

    public function __construct(LocationRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            //$locations      = $this->repo->getObjs();
            $locations      = array(
                array(
                    "id" => 1,
                  "name" => "Location 1",
                  "code" => "001",
                  "description" => "This is the Location 1"
                ),
                array(
                    "id" => 2,
                  "name" => "Location 2",
                  "code" => "002",
                  "description" => "This is the Location 2"
                  ),
                  array(
                    "id" => 3,
                  "name" => "Location 3",
                  "code" => "003",
                  "description" => "This is the Location 3"
                  ),
                  array(
                    "id" => 4,
                  "name" => "Location 4",
                  "code" => "004",
                  "description" => "This is the Location 4"
                   )
              );
            return view('backend.location.index')->with('locations',$locations);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {            
            return view('backend.location.location');
        }
        return redirect('/');
    }

    public function store(LocationEntryRequest $request)
    {
        

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $location        = Location::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjs();

            return view('backend.location.location')->with('location', $location)->with('countries', $countries);
        }
        return redirect('/backend_app/login');
    }

    public function update(LocationEditRequest $request){
        
    }

    public function destroy(){

        
    }

}
