<?php

namespace App\Http\Controllers\Report;

use App\Setup\Report\ExpenseReportRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Core\Utility as Utility;
use App\Setup\ExpenseType\ExpenseTypeRepository;
use Illuminate\Support\Facades\Input;
use PDF;
use Excel;
use App\Exports\ExpenseSummaryView;

class ExpenseReportController extends Controller
{
    private $repo;

    public function __construct(ExpenseReportRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        if (Auth::check()) {
            $all_inputs = Input::all();
            $from_date       = isset($all_inputs['from_date']) ? $all_inputs['from_date'] : null ;
            $to_date       = isset($all_inputs['to_date']) ? $all_inputs['to_date'] : null ;
            $expense_type_id_arr       = isset($all_inputs['expense_type_id']) ? $all_inputs['expense_type_id'] : null ;
            $currency_id_arr       = isset($all_inputs['currency_id']) ? $all_inputs['currency_id'] : null ;
                        
            //$objs = $this->repo->getObjsAllByLastExpenseFilter();
            $objs = $this->repo->summary($expense_type_id_arr, $currency_id_arr, $from_date, $to_date);
            $currency_types = Utility::getCoreSettingsByType('CURRENCY');
            $expense_type_repo = new ExpenseTypeRepository();
            $expense_types = $expense_type_repo->getObjs();
            
            return view('report.expense.expense_report')
                ->with('objs', $objs)
                ->with('action_type', 'create')
                ->with('currency_types', $currency_types)
                ->with('expense_types', $expense_types)
                ->with('from_date', $from_date)
                ->with('to_date', $to_date)
                ->with('selected_currency_ids', $currency_id_arr)
                ->with('selected_expense_type_ids', $expense_type_id_arr);
        }
        return redirect('/');
    }

    public function exportPdf()
    {
        if (Auth::check()) {
            $all_inputs = Input::all();
            $from_date       = isset($all_inputs['from_date']) ? $all_inputs['from_date'] : null ;
            $to_date       = isset($all_inputs['to_date']) ? $all_inputs['to_date'] : null ;
            $expense_type_id_arr       = isset($all_inputs['expense_type_id']) ? $all_inputs['expense_type_id'] : null ;
            $currency_id_arr       = isset($all_inputs['currency_id']) ? $all_inputs['currency_id'] : null ;

            $objs = $this->repo->summary($expense_type_id_arr, $currency_id_arr, $from_date, $to_date);
            $currency_types = Utility::getCoreSettingsByType('CURRENCY');
            $expense_type_repo = new ExpenseTypeRepository();
            $expense_types = $expense_type_repo->getObjs();

            // This  $data array will be passed to our PDF blade
            $data = [
                'objs' => $objs,
                'action_type' => 'create',
                'currency_types' => $currency_types,
                'expense_types' => $expense_types,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'selected_currency_ids' => $currency_id_arr,
                'selected_expense_type_ids' => $expense_type_id_arr,
                ];
            
            $pdf = PDF::loadView('report.expense.expense_summary', $data);
            return $pdf->download('expense_report.pdf');
        }
        return redirect('/');
    }

    public function exportExcel()
    {
        if (Auth::check()) {
            $all_inputs = Input::all();
            $from_date       = isset($all_inputs['from_date']) ? $all_inputs['from_date'] : null ;
            $to_date       = isset($all_inputs['to_date']) ? $all_inputs['to_date'] : null ;
            $expense_type_id_arr       = isset($all_inputs['expense_type_id']) ? $all_inputs['expense_type_id'] : null ;
            $currency_id_arr       = isset($all_inputs['currency_id']) ? $all_inputs['currency_id'] : null ;

            $objs = $this->repo->summary($expense_type_id_arr, $currency_id_arr, $from_date, $to_date);
            $currency_types = Utility::getCoreSettingsByType('CURRENCY');
            $expense_type_repo = new ExpenseTypeRepository();
            $expense_types = $expense_type_repo->getObjs();
            ;

            
            // This  $data array will be passed to our PDF blade
            $data = [
                'objs' => $objs,
                'action_type' => 'create',
                'currency_types' => $currency_types,
                'expense_types' => $expense_types,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'selected_currency_ids' => $currency_id_arr,
                'selected_expense_type_ids' => $expense_type_id_arr,
                ];
            
            return Excel::download(new ExpenseSummaryView($data), 'export.xlsx');
        }
        return redirect('/');
    }

    public function excel($type = null, $from = null, $to = null)
    {
        if (Auth::check()) {
            ob_end_clean();
            ob_start();

            $bookings       = $this->repo->saleSummaryReport($type, $from, $to);
            $grandTotal     = 0.00;

            if (isset($bookings) && count($bookings) > 0) {
                foreach ($bookings as $booking) {
                    $grandTotal += $booking->total_payable_amt;
                }
            }

            Excel::create('SaleSummaryReport', function ($excel) use ($bookings,$grandTotal) {
                $excel->sheet('SaleSummaryReport', function ($sheet) use ($bookings,$grandTotal) {
                    $displayArray   = array();
                    $count          = 0;
                    if (isset($bookings) && count($bookings) > 0) {
                        foreach ($bookings as $value) {
                            $count++;
                            $displayArray[$value->id]['Date']           = $value->date;
                            $displayArray[$value->id]['Booking Number'] = $value->booking_no;
                            $displayArray[$value->id]['Customer Name']  = $value->first_name.' '.$value->last_name;
                            $displayArray[$value->id]['Total Amount']   = number_format($value->total_payable_amt, 2);
                        }
                    }
                    $count          = $count +2;
                    $sheet->fromArray($displayArray);
                    $sheet->appendRow(array('Grand Total','','',number_format($grandTotal, 2)));
                    $sheet->row(1, function ($row) {
                        $row->setBackground('blueviolet');
                        $row->setFontSize(13);
                        $row->setFontColor('#ffffff');
                    });
                    $sheet->cells('A'.$count.':D'.$count, function ($cells) {
                        $cells->setBackground('blueviolet');
                        $cells->setFontColor('#ffffff');
                    });
                });
            })->download('xls');

            ob_flush();
            return Redirect();
        }
        return redirect('/');
    }
}
