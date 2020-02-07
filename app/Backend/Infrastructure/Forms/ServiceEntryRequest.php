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

class ServiceEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|unique:services,name,'.$this->get('id'),
            'code'          => 'required|unique:services,code,'.$this->get('id').',id,code,'.Input::get('code').',deleted_at,NULL',
           // 'photo'              => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Service Name is required!',
            'name.unique'        => 'Service already exists!',
            'code.required'      => 'Service Code is required!',
            'code.unique'        => 'Service Code already exists!',
           // 'photo.required'     => 'Photo is required!'
        ];
    }
}
