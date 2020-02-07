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

class TownshipEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'city_id'       => 'required',
             'name'          => 'required',
            // 'name'          => 'required|unique:townships,name,NULL,id,city_id,'.Input::get('city_id').',deleted_at,NULL',
        ];
    }
    public function messages()
    {
        return [
            'city_id'                => 'City is required',
            'name.required'          => 'Township Name is required!',
            // 'name.unique'            => 'The name has already been taken!'

        ];
    }
}
