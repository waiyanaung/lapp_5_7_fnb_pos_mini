<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class SystemReferenceController extends Controller
{
    private $cityRepository;

    public function __construct()
    {

    }

    public function index()
    {
        if(Auth::check()) {
            return view('backend.systemreference.index');
        }
        return redirect('/backend_app/login');   
    }
}
