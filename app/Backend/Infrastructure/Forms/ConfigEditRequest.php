<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class ConfigEditRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'GST'                  => 'numeric',
            'SERVICE_TAX'          => 'numeric',
        ];
    }
    public function messages()
    {
        return [
            'GST.numeric'           => 'Government Tax must be a number!',
            'SERVICE_TAX.numeric'   => 'Service Charge must be a number!',
        ];
    }
}
