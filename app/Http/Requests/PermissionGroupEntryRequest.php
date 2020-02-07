<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionGroupEntryRequest extends FormRequest
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
             "level" =>"required",
             "group_code" => "required"
         ];
     }
     public function messages(){
         return [
             "name.required" => "Menu Name is required",
             "level.required" => "Level is required",
             "group_code.required" => "Group Code is required"
         ];
     }
}
