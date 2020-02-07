<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class PageEditRequest extends Request
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
            'page_name'              => 'required',
            'content'                => 'required',
        ];
    }

    public function messages()
    {
        return [
            'page_name.required'          => 'Page name is required!',
            'content.required'            => 'Content is required!',
        ];
    }
}
