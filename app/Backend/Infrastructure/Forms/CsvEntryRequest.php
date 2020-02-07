<?php

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;

class CsvEntryRequest extends Request
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
            'tbl_name'          => 'required',
            'csv_upl'           => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tbl_name.required'          => 'Table is required!',
            'csv_upl.required'           => 'CSV file is required!',
            'csv_upl.mimes'              => 'File Type must be CSV',
        ];
    }
}
