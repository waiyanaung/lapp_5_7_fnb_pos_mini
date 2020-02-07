<?php

namespace App\Http\Controllers\Frontend;

use App\Core\Check;
use App\Core\ReturnMessage;
use App\Setup\Customer\CustomerRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Core\Nrc\Nrc;
use App\Core\Nrc\NrcRepository;
use Image;
use App\Core\Utility;
use App\Http\Requests\CustomerEntryRequest;
use Illuminate\Support\Facades\Validator;
use App\Setup\Township\Township;
use App\Setup\TransactionItemTemp\TransactionItemTemp;
use App\Setup\TransactionOrder\TransactionOrder;

class CartController extends Controller
{
    private $repo;
    public function __construct(CustomerRepositoryInterface $repo){
        $this->repo = $repo;
    }

    public function create(){
        
        if(Check::validSessionCustomer()){
            return redirect('/');
        }
        else{
            $townships = Township::query()
                    ->where('city_id', '=', 14) 
                    ->get();                    
            return view('frontend.registration')->with('townships',$townships);
        }
        return redirect('/');
        
    }

    public function store(Request $request){        
        $loggedId = Check::validSessionCustomer();
        if($loggedId == false){
            return redirect('/');
        }

        $response                           = array();
        $all_input = Input::all();
        $item_id = Input::get('item_id');

        $rules = [
            'qty'     => 'required|integer'
         ];       

        $messages = [
            'qty.required'    => '* Air-Con Quantity is required !',
        ];

        $validator = Validator::make($all_input, $rules, $messages);
        
        if ($validator->fails()) {
            return redirect('/item_detail/' . $item_id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $qty = trim(Input::get('qty'));
        $item_id = trim(Input::get('item_id'));
        $add_installation = trim(Input::get('add_installation'));
        $session_customer = Check::getSessionCustomer();
        $customer_id = $session_customer['id'];
        $date = date('Y-m-d');

        $insert_success_count = 0;
        
        try{
            DB::beginTransaction();

            for($i=0; $i<$qty; $i++){
                $paramObj = new TransactionItemTemp();
                $table_name = $paramObj->getTable();

                $last_id = Check::getTableIncrementId($table_name,$date);
                
                $paramObj = new TransactionItemTemp();        
                $paramObj->id = $last_id;
                $paramObj->customer_id = $customer_id;
                $paramObj->date = $date;
                $paramObj->item_id = $item_id;
                $paramObj->total_item_qty = 1;
                $paramObj->add_installation = $add_installation;
                $paramObj->created_by = $customer_id;
                $paramObj->updated_by = $customer_id;
                
                $res = $this->repo->create($paramObj);

                if($res['laravelStatusCode'] == ReturnMessage::OK){                
                    $insert_success_count++;                    
                }
                else{                
                    DB::rollback();
                    alert()->error('Adding item to cart is fail!', 'Fail')->persistent('CLOSE');
                    return redirect('/item_detail/' . $item_id);
                }
            }
        
            if($insert_success_count == $qty){
                DB::commit();
                alert()->success('Adding item to cart is successful.', 'Success')->persistent('CLOSE');                
                return redirect('/item_detail/' . $item_id);
            }
            else{
                DB::rollback();
                    alert()->error('Adding item to cart is fail!', 'Fail')->persistent('CLOSE');
                    return redirect('/item_detail/' . $item_id);
            }
            

        }
        catch(\Exception $e){  
            
            DB::rollback();
            alert()->error('Adding items to card is fail with unexpected error. Please connect to the web admin. sorry for error !', 'Fail')->persistent('CLOSE');
            return redirect('/item_detail/' . $item_id);
        }
        
        alert()->error('Adding item to cart Operation can not start', 'Fail')->persistent('CLOSE');
        return redirect('/item_detail/' . $item_id);
    }

    public function order(Request $request){

        $response                           = array();
        $all_input = Input::all();
        $item_id = Input::get('item_id');

        if($request->ajax()){
            return redirect('/item_detail/' . $item_id);
        }

        $rules = [
            'qty'     => 'required|integer',
            'name'     => 'required',
            'phone'     => 'required',
         ];       

        $messages = [
            'qty.required'    => '* Air-Con Quantity is required !',
            'name.required'    => '* Order Person Name is required !',
            'phone.required'    => '* Order Person Phone is required !',
        ];

        $validator = Validator::make($all_input, $rules, $messages);
        
        if ($validator->fails()) {
            return redirect('/item_detail/' . $item_id)
                        ->withErrors($validator)
                        ->withInput();
        }


        $qty = trim(Input::get('qty'));
        $item_id = trim(Input::get('item_id'));
        $add_installation = trim(Input::get('add_installation'));
        $name = trim(Input::get('name'));
        $phone = trim(Input::get('phone'));         
        $date = date('Y-m-d');
        
        try{
            DB::beginTransaction();
            $paramObj = new TransactionOrder();
            $table_name = $paramObj->getTable();

            $last_id = Check::getTableIncrementId($table_name,$date);
            
            $paramObj = new TransactionOrder();        
            $paramObj->id = $last_id;
            $paramObj->name = $name;
            $paramObj->phone = $phone;            
            $paramObj->date = $date;
            $paramObj->item_id = $item_id;
            $paramObj->total_item_qty = $qty;
            $paramObj->add_installation = $add_installation;
            
            $res = $this->repo->create($paramObj);

            if($res['laravelStatusCode'] == ReturnMessage::OK){                
                DB::commit();

                //  Confirmation Mail Send
                $sendMailResult             = Utility::sendOrderMail($paramObj);            

                alert()->success('Your order sent successfully and Our system admin will phone to you soon. Thanks a lot for order.', 'Order sent successfully')->persistent('OK');
                return redirect('/item_detail/' . $item_id);                   
            }
            else{                
                DB::rollback();
                alert()->error('Sending Order is fail!', 'Fail')->persistent('CLOSE');
                return redirect('/item_detail/' . $item_id);
            }
                       

        }
        catch(\Exception $e){  
            
            DB::rollback();
            alert()->error('Sending Order is fail with unexpected error. Please connect to the web admin. sorry for error !', 'Fail')->persistent('CLOSE');
            return redirect('/item_detail/' . $item_id);
        }
        
        alert()->error('Sending Order Operation can not start', 'Fail')->persistent('CLOSE');
        return redirect('/item_detail/' . $item_id);
    }


    public function verify($confirmation_code)
    {
//        $last_pos           = strripos($confirmation_code,'_')+1;
        $password           = base64_decode(substr($confirmation_code,21));
        $activation_code    = substr($confirmation_code,0,20);

        $customer           = User::where('activation_code',$activation_code)->whereNull('deleted_at')->first();
        $customer->confirm  = 1;
        $customer->save();

        $email              = $customer->email;

        $auth = auth()->guard('Customer');
        $credentials = [
            'email'     => $email,
            'password'  => $password
        ];
        if($auth->attempt($credentials)){
            $auth_id = auth()->guard('Customer')->id();
            Check::createSessionCustomer($auth_id);
            return redirect('bookingList');
        }
        return redirect('/');

    }

    public function check_email(){
        $email      = Input::get('email');
        $customer   = User::where('email','=',$email)->whereNull('deleted_at')->get();
        $result     = false;
        if(count($customer) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }
}
