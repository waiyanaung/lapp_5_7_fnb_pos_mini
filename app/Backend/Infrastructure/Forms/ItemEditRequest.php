<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use App\Setup\Item\ItemRepository;
use Illuminate\Support\Facades\Input;

class ItemEditRequest extends Request
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
            'country_id' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Item Name is required!',
            'name.unique'        => 'Item already exists!',
            'model.required'      => 'Item Model is required!',
            
            
        ];
    }
}
