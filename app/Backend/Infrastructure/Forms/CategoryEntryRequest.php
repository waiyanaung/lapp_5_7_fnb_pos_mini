<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;

class CategoryEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|unique:categories,name,'.$this->get('id'),
            // 'code'          => 'required|unique:categories,code,'.$this->get('id').',id,code,'.Input::get('code').',deleted_at,NULL',
           // 'photo'              => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Category Name is required!',
            'name.unique'        => 'Category already exists!',
            // 'code.required'      => 'Category Code is required!',
            // 'code.unique'        => 'Category Code already exists!',
           // 'photo.required'     => 'Photo is required!'
        ];
    }
}
