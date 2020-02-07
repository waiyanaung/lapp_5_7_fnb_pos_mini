<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use App\Setup\GalleryImage\GalleryImageRepository;
use Illuminate\Support\Facades\Input;

class GalleryImageEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'gallery_id'         => 'required'
        ];
    }
    public function messages()
    {
        return [
            'gallery_id'         => 'gallery id is required'
        ];
    }
}
