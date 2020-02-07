<?php

namespace App\Http\Controllers\Report;

use App\Setup\Report\ReportRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

class SaleSummaryReportController extends Controller
{
    private $repo;

    public function __construct(ReportRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if(Auth::check()) {
            $type       = null;
            $from_date  = null;
            $to_date    = null;
            $grandTotal = 0.00;

            $bookings = $this->repo->saleSummaryReport($type,$from_date,$to_date);
            if(isset($bookings) && count($bookings) > 0){
                foreach($bookings as $booking){
                    $grandTotal += $booking->total_payable_amt;
                }
            }

            return view('report.sale_summary_report')->with('bookings',$bookings)
                ->with('grandTotal',$grandTotal);
        }
        return redirect('/');

    }

    public function search($type = null, $from = null, $to = null){
        if(Auth::check()) {
            $from_year      = null;
            $to_year        = null;
            $from_month     = null;
            $to_month       = null;
            $from_date      = null;
            $to_date        = null;
            $grandTotal     = 0.00;

            if($type == "yearly"){
                $from_year  = $from;
                $to_year    = $to;
            }
            if($type == "monthly"){
                $from_month = $from;
                $to_month   = $to;
            }
            if($type == "daily"){
                $from_date  = $from;
                $to_date    = $to;
            }
            $bookings       = $this->repo->saleSummaryReport($type, $from, $to);

            if(isset($bookings) && count($bookings) > 0){
                foreach($bookings as $booking){
                    $grandTotal += $booking->total_payable_amt;
                }
            }

            return view('report.sale_summary_report')->with('bookings',$bookings)
                ->with('from_year',$from_year)
                ->with('from_month',$from_month)
                ->with('from_date',$from_date)
                ->with('to_year',$to_year)
                ->with('to_month',$to_month)
                ->with('to_date',$to_date)
                ->with('grandTotal',$grandTotal)
                ->with('type',$type) ;
        }
        return redirect('/');
    }

    public function excel($type = null, $from = null, $to = null){
        if(Auth::check()) {
            ob_end_clean();
            ob_start();

            $bookings       = $this->repo->saleSummaryReport($type, $from, $to);
            $grandTotal     = 0.00;

            if(isset($bookings) && count($bookings) > 0){
                foreach($bookings as $booking){
                    $grandTotal += $booking->total_payable_amt;
                }
            }

            Excel::create('SaleSummaryReport', function($excel)use($bookings,$grandTotal) {
                $excel->sheet('SaleSummaryReport', function($sheet)use($bookings,$grandTotal) {

                    $displayArray   = array();
                    $count          = 0;
                    if(isset($bookings) && count($bookings) > 0){
                        foreach($bookings as $value){
                            $count++;
                            $displayArray[$value->id]['Date']           = $value->date;
                            $displayArray[$value->id]['Booking Number'] = $value->booking_no;
                            $displayArray[$value->id]['Customer Name']  = $value->first_name.' '.$value->last_name;
                            $displayArray[$value->id]['Total Amount']   = number_format($value->total_payable_amt,2);
                        }
                    }
                    $count          = $count +2;
                    $sheet->fromArray($displayArray);
                    $sheet->appendRow(array('Grand Total','','',number_format($grandTotal,2)));
                    $sheet->row(1,function($row){
                        $row->setBackground('blueviolet');
                        $row->setFontSize(13);
                        $row->setFontColor('#ffffff');
                    });
                    $sheet->cells('A'.$count.':D'.$count, function($cells) {
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
