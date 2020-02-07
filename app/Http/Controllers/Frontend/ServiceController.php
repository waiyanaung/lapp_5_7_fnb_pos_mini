<?php
/**
 * Created by Visual Studio Code.
 * User: william
 * Author: Wai Yan Aung
 * Date: 1/14/2019
 * Time: 10:55 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Setup\Service\Service;
use App\Setup\Service\ServiceRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(ServiceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {

        $objs = array();
        $objs = $this->repo->getObjs();
        return view('frontend.service')->with('objs', $objs);
    }

    public function detail($id)
    {

        try {
            $obj_service = Service::find($id);
            if (isset($obj_service) && count((array)$obj_service)>0) {
                return view('frontend.service_detail')
                    ->with('obj', $obj_service);
            }
            else{
                $objs = array();
                $objs = $this->repo->getObjs();
                return view('frontend.service')->with('objs', $objs);
            }
        } catch (Exception $ex) {
            return view('/');
        }

    }

}
