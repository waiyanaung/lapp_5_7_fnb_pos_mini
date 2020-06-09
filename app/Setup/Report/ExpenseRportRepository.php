<?php
namespace App\Setup\Report;
use App\Setup\Booking\Booking;
use App\Setup\BookingPayment\BookingPayment;
use Illuminate\Support\Facades\DB;
use App\Setup\Expense\Expense;

/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 6/8/2020
 * Time: 9:46 AM
 */
class ExpenseReportRepository implements ExpenseReportRepositoryInterface
{

    public function getObjs(){
        
        $rawObjs = Expense::whereNull('deleted_at')->get();
        $objs = array();
        foreach($rawObjs as $rawObj){
            $objs[$rawObj->id] = $rawObj;
        }
        return $objs;
    }

    public function summary($expense_type_id_arr=null,$currency_id_arr=null, $from=null, $to=null){
        
        $query      = "SELECT *
                        FROM 
                        expenses 
                        WHERE status = 1 ";
        
        if($expense_type_id_arr != null){
            $temp_string = "";
            $counter_type = 0;
            $arr_count_type = count($expense_type_id_arr);
            foreach($expense_type_id_arr as $expense_type_id){
                $temp_string .= $expense_type_id;
                $counter_type++;
                if($counter_type < $arr_count_type){
                    $temp_string .= ",";
                }
            }
            $query .= " AND expense_type_id IN (". $temp_string  .") ";
         }

        if($currency_id_arr != null){
            $temp_currency = "";
            $counter_currency = 0;
            $arr_count_currency = count($currency_id_arr);
            foreach($currency_id_arr as $currency_id){
                $temp_currency .= "'". $currency_id ."'";
                $counter_currency++;
                if($counter_currency < $arr_count_currency){
                    $temp_currency .= ",";
                }
            }
            
            $query .= " AND currency_id IN (". $temp_currency .") ";
        }
       
        if($from != null){
            $query .= " AND date >= '" . $from ."'";
        } 
        
        if($to != null){
            $query .= " AND date <= '" . $to ."'";
        }
        $raw_objs = DB::select($query);
        return $raw_objs;
    }

    public function sample($type=null, $from=null, $to=null){
        $query      = Booking::query();
        // $query      = $query->leftjoin('booking_payment', 'bookings.id', '=', 'booking_payment.booking_id');
        $query      = $query->leftjoin('core_users','bookings.user_id','=','core_users.id');
        // $query      = $query->select('bookings.id as id','bookings.booking_no','bookings.user_id','bookings.status',
        //                              'booking_payment.booking_id','booking_payment.status',
        //                              'booking_payment.total_payable_amt','core_users.first_name',
        //                              'core_users.last_name',DB::raw('DATE(bookings.created_at) as date'));

        $query      = $query->select('bookings.id as id','bookings.booking_no','bookings.user_id','bookings.status',
                                      'bookings.total_payable_amt','core_users.first_name',
                                      'core_users.last_name',DB::raw('DATE(bookings.created_at) as date'));


        if(isset($type) && $type != null && $type == 'yearly'){
            if(isset($from) && $from != null){
                $tempFromDate   = date("Y", strtotime('01-01-'.$from));
                $query          = $query->whereYear('bookings.created_at', '>=' , $tempFromDate);
            }
            if(isset($to) && $to != null){
                $tempToDate     = date("Y", strtotime('31-12-'.$to));
                $query          = $query->whereYear('bookings.created_at', '<=', $tempToDate);
            }
        }
        else if(isset($type) && $type != null && $type == 'monthly'){
            if(isset($from) && $from != null){
                $tempFromDate   = date("Y-m-d", strtotime('01-'.$from));
                $query          = $query->whereDate('bookings.created_at', '>=' , $tempFromDate);
            }
            if(isset($to) && $to != null){
                $tempToDate     = date("Y-m-d", strtotime('31-'.$to));
                $query          = $query->whereDate('bookings.created_at', '<=', $tempToDate);
            }
        }
        else{
            if(isset($from) && $from != null){
                $tempFromDate   = date("Y-m-d", strtotime($from));
                $query          = $query->whereDate('bookings.created_at', '>=' , $tempFromDate);
            }
            if(isset($to) && $to != null){
                $tempToDate     = date("Y-m-d", strtotime($to));
                $query          = $query->whereDate('bookings.created_at', '<=', $tempToDate);
            }
        }

        $query      = $query->whereNull('bookings.deleted_at');
        $query      = $query->where('bookings.status','!=',3);
        // $query      = $query->where('bookings.status','=',2);
        // $query      = $query->where('booking_payment.status','=',2);
//        $query = $query->groupBy(DB::raw("DATE(bookings.created_at)"));
        $result     = $query->get();
        return $result;
    }


}
