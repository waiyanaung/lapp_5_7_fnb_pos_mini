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

class ProductEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'country_id'         => 'required',
            'name'          => 'required|unique:cities,name,NULL,id,country_id,'.Input::get('country_id').',deleted_at,NULL',
            'code'          => 'required|unique:cities,code,NULL,id,code,'.Input::get('code').',deleted_at,NULL'
        ];
    }
    public function messages()
    {
        return [
            'country_id.required'=> 'Country is required',
            'name.required'      => 'Product Name is required!',
            'name.unique'        => 'Product already exists!',
            'code.required'      => 'Product Code is required!',
            'code.unique'        => 'Product Code already exists!'
        ];
    }
}
