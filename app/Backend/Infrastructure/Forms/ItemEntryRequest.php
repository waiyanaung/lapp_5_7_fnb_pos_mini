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

class ItemEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|unique:items,name,'.$this->get('id'),
            'model'          => 'required',
            'brand_id' => 'required',
            'country_id' => 'required',            
            'price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Item Name is required!',
            'name.unique'        => 'Item already exists!',
            'model.required'      => 'Item Model is required!',
            'brand_id.required' => 'Brand Name is required!',
            'country_id.required' => 'Made In is requried!',            
        ];
    }
}
