<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class ExpenseTypeEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            // 'name'          => "required|string|unique:expense_type,name,".$this->get('id'),
            'name'          => 'required|unique:expense_type,name,'.$this->get('id').',id,deleted_at,NULL',
        ];
    }
    public function messages()
    {
        return [
            'name.required'         => 'Country Name is required!',
            'name.unique'           => 'The name has already been taken!',
            'name.string'           => 'Country Name must be a string!',
        ];
    }
}
