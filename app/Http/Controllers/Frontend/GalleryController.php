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
use App\Setup\GalleryImage\GalleryImageRepository;
use App\Setup\Gallery\Gallery;
use App\Setup\Gallery\GalleryRepositoryInterface;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct(GalleryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {

        $objs = array();
        $objs = $this->repo->getObjs();
        return view('frontend.gallery')->with('objs', $objs);
    }

    public function gallery_detail($id)
    {
        try {
            $obj_gallery = Gallery::find($id);

            $galleryImageRepo = new GalleryImageRepository();
            $objs_galleryimages = $galleryImageRepo->getByParentId($id);

            return view('frontend.gallery_detail')
                ->with('obj_gallery', $obj_gallery)
                ->with('objs_galleryimages', $objs_galleryimages);
        } catch (Exception $ex) {
            return view('/');
        }

    }

}
