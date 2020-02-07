<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use App\Setup\Team\TeamRepository;
use Illuminate\Support\Facades\Input;

class TeamEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|unique:teams,name,'.$this->get('id'),
            'code'          => 'required|unique:teams,code,'.$this->get('id').',id,code,'.Input::get('code').',deleted_at,NULL',
           // 'photo'              => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Team Name is required!',
            'name.unique'        => 'Team already exists!',
            'code.required'      => 'Team Code is required!',
            'code.unique'        => 'Team Code already exists!',
           // 'photo.required'     => 'Photo is required!'
        ];
    }
}
