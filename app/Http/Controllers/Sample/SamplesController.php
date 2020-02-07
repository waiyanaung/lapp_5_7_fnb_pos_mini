<?php

namespace App\Http\Controllers\Sample;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SamplesController extends Controller
{
    public function index()
    {
        return view('sample.googlemap');
    }

    public function getLocations()
    {

        $locations = [
            ['<b>Bondi Beach</b><a href="/cl/systemreference"><img src="/images/logo.jpg"></a>', -33.890542, 151.274856, 4],
            ['Coogee Beach</b><a href="/cl/systemreference"><img src="/images/logo.jpg"></a>', -33.923036, 151.259052, 5],
            ['Cronulla Beach</b><a href="/cl/systemreference"><img src="/images/logo.jpg"></a>', -34.028249, 151.157507, 3],
            ['Manly Beach</b><a href="/cl/systemreference"><img src="/images/logo.jpg"></a>', -33.80010128657071, 151.28747820854187, 2],
            ['Maroubra Beach</b><a href="/cl/systemreference"><img src="/images/logo.jpg"></a>', -33.950198, 151.259302, 1]
        ];

        return response()->json($locations);
    }
}
