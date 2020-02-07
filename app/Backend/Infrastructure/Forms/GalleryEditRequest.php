<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use App\Setup\leery\GalleryRepository;
use Illuminate\Support\Facades\Input;

class GalleryEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|unique:articles,name,'.$this->get('id'),
            'code'          => 'required|unique:articles,code,'.$this->get('id').',id,code,'.Input::get('code').',deleted_at,NULL',
           // 'photo'              => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Article Name is required!',
            'name.unique'        => 'Article already exists!',
            'code.required'      => 'Article Code is required!',
            'code.unique'        => 'Article Code already exists!',
           // 'photo.required'     => 'Photo is required!'
        ];
    }
}
