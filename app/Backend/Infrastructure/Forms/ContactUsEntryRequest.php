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

class ContactUsEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'first_name'            => 'required',
            'email'                 => 'required',
            'phone'                 => 'required',
            'detail_info'           => 'required'
        ];
    }
    public function messages()
    {
        return [
            'first_name.required'      => 'First Name is required!',
            'email.required'      => 'Email is required!',
            'phone.required'      => 'Phone No. is required!',
            'detail_info.required'      => 'Message is required!'
        ];
    }
}
