<?php
/**
 * Author: william
 * Date: 2017-11-30
 * Time: 10:47 AM
 */

namespace App\Http\Controllers\Setup\Activities;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Allergy\AllergyRepositoryInterface;
use App\Backend\Allergy\Allergy;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use Illuminate\Support\Facades\Storage;

class ActivitiesController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $dir = storage_path('logs');

            $rawFiles = scandir($dir);

            $logArray = array();

            foreach ($rawFiles as $rawFile){
                if (0 === strpos($rawFile, 'custom-laravel-')){
                    $logDateRaw = str_replace('custom-laravel-',"",$rawFile);
                    $logDate = str_replace('.log',"",$logDateRaw);
                    $logfileNameWithPath = $dir . "/" . $rawFile;
                    $activities = file($logfileNameWithPath, FILE_IGNORE_NEW_LINES);
                    $logArray[$logDate] = $activities;
                }
            }
            krsort($logArray); //sort log array by date in descending order
            return view('backend.log.activities')->with('logArray',$logArray);
        }
        return redirect('/');
    }
}
