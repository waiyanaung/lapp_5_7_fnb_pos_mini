<?php

namespace App\Exports;

use App\Sample;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;

class ExpenseSummaryView implements FromView
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $paramObj = $this->data;
        
        return view('exports.expense_summary_html', [
            
            'objs' => $paramObj['objs'],
            'action_type' => 'create',
            'currency_types' => $paramObj['currency_types'],
            'expense_types' => $paramObj['expense_types'],
            'from_date' => $paramObj['from_date'],
            'to_date' => $paramObj['to_date'],
            'selected_currency_ids' => $paramObj['selected_currency_ids'],
            'selected_expense_type_ids' => $paramObj['selected_expense_type_ids'],
        ]);
    }
}
