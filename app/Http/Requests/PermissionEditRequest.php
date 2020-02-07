<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionEditRequest extends FormRequest
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
             "name" =>"required",
             "module" =>"required",
             "url" => "required"
         ];
     }
     public function messages(){
         return [
             "name.required" => "Role Name is required",
             "module.required" => "Module is required",
             "url.required" => "URL is required"
         ];
     }
}
