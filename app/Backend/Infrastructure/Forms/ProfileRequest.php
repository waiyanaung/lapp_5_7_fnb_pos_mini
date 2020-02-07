<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class ProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "first_name"        => "required",
            "last_name"         => "required",
            "email"             => "required|email|unique:core_users,email,".$this->get('id')
        ];
    }

    public function messages()
    {
        return [
            "first_name.required"       => "First name is required!",
            "last_name.required"        => "Last name is required!",
            "email.required"            => "Email is required!",
        ];
    }
}
