<?php
namespace App\Setup\Report;
use App\Setup\Booking\Booking;
use App\Setup\BookingPayment\BookingPayment;
use Illuminate\Support\Facades\DB;

/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 5/25/2017
 * Time: 9:46 AM
 */
class ReportRepository implements ReportRepositoryInterface
{
    public function saleSummaryReport($type=null, $from=null, $to=null){
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

//     public function bookingReport($type=null, $from=null, $to=null, $status=null){
//         $query      = Booking::query();
//         // $query      = $query->leftjoin('booking_payment', 'bookings.id', '=', 'booking_payment.booking_id');
//         $query      = $query->leftjoin('booking_room','bookings.id','=','booking_room.booking_id');
//         $query      = $query->leftjoin('core_users','bookings.user_id','=','core_users.id');
//         // $query      = $query->select('bookings.id as id','bookings.booking_no','bookings.user_id','bookings.status',
//         //                              'booking_payment.booking_id','booking_payment.status as payment_status',
//         //                              'booking_payment.total_payable_amt','core_users.first_name',
//         //                              'core_users.last_name',DB::raw('DATE(bookings.created_at) as date'));
//
//         $query      = $query->select('bookings.id as id','bookings.booking_no','bookings.user_id','bookings.status',
//                                      'booking_room.room_payable_amt_w_tax','booking_room.refund_amt','booking_room.status as booking_room_status',
//                                      'core_users.first_name',
//                                      'core_users.last_name',DB::raw('DATE(bookings.created_at) as date'));
//
//         if(isset($type) && $type != null && $type == 'yearly'){
//             if(isset($from) && $from != null){
//                 $tempFromDate   = date("Y", strtotime('01-01-'.$from));
//                 $query          = $query->whereYear('bookings.created_at', '>=' , $tempFromDate);
//             }
//             if(isset($to) && $to != null){
//                 $tempToDate     = date("Y", strtotime('31-12-'.$to));
//                 $query          = $query->whereYear('bookings.created_at', '<=', $tempToDate);
//             }
//         }
//         else if(isset($type) && $type != null && $type == 'monthly'){
//             if(isset($from) && $from != null){
//                 $tempFromDate   = date("Y-m-d", strtotime('01-'.$from));
//                 $query          = $query->whereDate('bookings.created_at', '>=' , $tempFromDate);
//             }
//             if(isset($to) && $to != null){
//                 $tempToDate     = date("Y-m-d", strtotime('31-'.$to));
//                 $query          = $query->whereDate('bookings.created_at', '<=', $tempToDate);
//             }
//         }
//         else{
//             if(isset($from) && $from != null){
//                 $tempFromDate   = date("Y-m-d", strtotime($from));
//                 $query          = $query->whereDate('bookings.created_at', '>=' , $tempFromDate);
//             }
//             if(isset($to) && $to != null){
//                 $tempToDate     = date("Y-m-d", strtotime($to));
//                 $query          = $query->whereDate('bookings.created_at', '<=', $tempToDate);
//             }
//         }
//
//         if($status != 0){
//             $query = $query->where('bookings.status','=',$status);
//         }
//
//         $query      = $query->whereNull('bookings.deleted_at');
//         // $query      = $query->where('bookings.status','!=',3);
//
// //        $query = $query->groupBy(DB::raw("DATE(bookings.created_at)"));
//         $result     = $query->get();
//         return $result;
//     }

    public function bookingReport($type=null, $from=null, $to=null, $status=null){
        $query      = Booking::query();
        $query      = $query->leftjoin('core_users','bookings.user_id','=','core_users.id');
        $query      = $query->select('bookings.*','core_users.first_name','core_users.last_name', DB::raw('DATE(bookings.created_at) as date'));

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

        if($status != 0){
            $query = $query->where('bookings.status','=',$status);
        }

        $query      = $query->whereNull('bookings.deleted_at');
        $query      = $query->whereNull('core_users.deleted_at');
        $result     = $query->get();
        return $result;
    }
}
