<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/05/2020
 * Time: 3:56 PM
 */

namespace App\Backend\Infrastructure\Forms;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;

class ExpenseEntryRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|max:255',
            'date'          => 'required',
            'expense_type_id' => 'required',
            'currency_id' => 'required',            
            'amount' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'      => 'Expense Name is required!',            
            'date.required'      => 'Expense Date is required!',
            'expense_type_id.required' => 'Expense Type is required!',
            'currency_id.required' => 'Currency Type is requried!',
            'amount.required' => 'Currency Amount is requried!',
        ];
    }
}
