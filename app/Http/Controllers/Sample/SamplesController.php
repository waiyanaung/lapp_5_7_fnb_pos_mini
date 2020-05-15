<?php

namespace App\Http\Controllers\Sample;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Sample;
class SamplesController extends Controller
{
    public function index()
    {
        return view('sample.googlemap');
    }

    public function getLocations()
    {

        $locations = [
            ['<b>Bondi Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -33.890542, 151.274856, 4],
            ['Coogee Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -33.923036, 151.259052, 5],
            ['Cronulla Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -34.028249, 151.157507, 3],
            ['Manly Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -33.80010128657071, 151.28747820854187, 2],
            ['Maroubra Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -33.950198, 151.259302, 1]
        ];

        return response()->json($locations);
    }

    public function addMore()
    {
        return view("backend.sample.dynamic_form");
    }


    public function addMorePost(Request $request)
    {
        $rules = [];


        foreach($request->input('name') as $key => $value) {
            $rules["name.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {


            foreach($request->input('name') as $key => $value) {
                Sample::create(['name'=>$value]);
            }


            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
