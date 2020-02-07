<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use App\Setup\Brand\BrandRepository;
use Illuminate\Support\Facades\Input;

class BrandEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|unique:brands,name,'.$this->get('id'),
            // 'code'          => 'required|unique:brands,code,'.$this->get('id').',id,code,'.Input::get('code').',deleted_at,NULL',
           // 'photo'              => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Brand Name is required!',
            'name.unique'        => 'Brand already exists!',
        //     'code.required'      => 'Brand Code is required!',
        //     'code.unique'        => 'Brand Code already exists!',
        //    // 'photo.required'     => 'Photo is required!'
        ];
    }
}
