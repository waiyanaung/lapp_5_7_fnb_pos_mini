<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use App\Setup\Slider\SliderRepository;
use Illuminate\Support\Facades\Input;

class SliderEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|unique:sliders,name,'.$this->get('id'),
            'code'          => 'required|unique:sliders,code,'.$this->get('id').',id,code,'.Input::get('code').',deleted_at,NULL',
           // 'photo'              => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Slider Name is required!',
            'name.unique'        => 'Slider already exists!',
            'code.required'      => 'Slider Code is required!',
            'code.unique'        => 'Slider Code already exists!',
           // 'photo.required'     => 'Photo is required!'
        ];
    }
}
