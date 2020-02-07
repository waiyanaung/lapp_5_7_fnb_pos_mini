<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use App\Setup\Service\ServiceRepository;
use Illuminate\Support\Facades\Input;

class FaqInformationEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required',
            'detail_info'   => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Question is required!',
            'detail_info.required'        => 'Answer is required!',
        ];
    }
}
