<?php

namespace App\Http\Controllers\Setup\Transaction;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use App\Core\User\UserRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ProductEntryRequest;
use App\Backend\Infrastructure\Forms\ProductEditRequest;
use App\Setup\Transaction\TransactionRepositoryInterface;
use App\Setup\Transaction\Transaction;
use App\Setup\TransactionItem\TransactionItemRepository;
use App\Setup\TransactionItem\TransactionItem;
use App\Setup\TransactionPayment\TransactionPaymentRepository;
use App\Setup\TransactionPayment\TransactionPayment;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

use Illuminate\Support\Facades\Validator;
use App\Sample;
use App\Setup\Township\Township;
use App\Setup\Category\CategoryRepository;
use App\Setup\Item\ItemRepository;

class TransactionController extends Controller
{
    private $repo;

    public function __construct(TransactionRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
        $objs      = $this->repo->getObjsByLastCreated();
            return view('backend.transaction.index')->with('objs',$objs);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            $countryRepo = new CountryRepository();
            $countries = $countryRepo->getObjs();

            $userRepo = new UserRepository();
            $customers = $userRepo->getUsersByRoleId(5);

            $categoryRepo = new CategoryRepository();
            $categories = $categoryRepo->getObjs();

            $itemRepo = new ItemRepository();
            $items = $itemRepo->getObjs();

            $obj = new Transaction();

            return view('backend.transaction.transaction')
                        ->with('countries',$countries)
                        ->with('customers',$customers)
                        ->with('categories',$categories)
                        ->with('items',$items);
                            
        }
        return redirect('/');
    }

    public function store(Request $request){
        
        
            
            $rules = [];
            $rules["customer_id"] = 'required';
            $custom_inputs = array();
            $custom_inputs['customer_id'] = $request->input('customer_id');

            $input_category_ids = $request->input('category_id');
            $input_item_ids = $request->input('item_id');
            $input_item_qtys = $request->input('item_qty');
            $input_prices = $request->input('price');
        
            foreach ($input_category_ids as $key => $value) {
                $custom_inputs['category_id' . $key] = $value;
                $rules["category_id".$key] = 'required';
            }

            foreach ($input_item_qtys as $key => $value) {
                $custom_inputs['item_qty' . $key] = $value;
                $rules["item_qty".$key] = 'required';
            }

            foreach ($input_item_ids as $key => $value) {
                $custom_inputs['item_id' . $key] = $value;
                $rules["item_id".$key] = 'required';
            }

            foreach ($input_prices as $key => $value) {
                $custom_inputs['price' . $key] = $value;
                $rules["price".$key] = 'required';
            }
       
            // $validator = Validator::make($request->all(), $rules);
            $validator = Validator::make($custom_inputs, $rules);
        
            if ($validator->fails()) {

                if ($request->ajax()) {
                    
                    return response()->json([
                        'fail'=>'Fail, Validation Error',
                        'error'  => $validator->errors()->all()
                       ]);
                }
                else{
                    return redirect('/backend_app/transaction/create')
                        ->withErrors($validator)
                        ->withInput();
                }

            } else {

                $service_charges = 0;
                $tax_percent = 0;
                $tax_type = 0;
                $tax_amt = 0;               
                $total_item_discounts = 0;
                
                $customer_id = $request->input('customer_id');
                $date = date('Y-m-d');
                $total_item_qty = 0;
                $sub_total = $request->input('sub_total');
                $remark = $request->input('remark');
                $payment_type = $request->input('payment_type');
                $paid_amt = $request->input('paid_amt');
                $change_amt = $request->input('change_amt');
                $payment_remark = $request->input('payment_remark');
                $due_amt = $request->input('due_amt');
                $main_discount_type = $request->input('main_discount_type'); 
                $main_discount_percent =  $request->input('main_discount_percent');
                $main_discount_value =  $request->input('main_discount_value');
                $main_discount_amt =  $request->input('main_discount_amt');
                $grand_total =  $request->input('grand_total');

                $paramObj = new Transaction();
                $table_name = $paramObj->getTable();
            
                $last_transaction_id = Check::getTableIncrementId($table_name, $date);
                $paramObj->id = $last_transaction_id;
                $paramObj->customer_id = $customer_id;
                $paramObj->date = $date;

                $transaction_items = array();
                $total_item_count = count($request->input('category_id'));
                for ($i = 0; $i < $total_item_count; $i++) {
                    $transaction_items[$i] = new TransactionItem();
                    $transaction_items[$i]->transaction_id = $last_transaction_id;
                    $transaction_items[$i]->date = $date;
                }
            
                $categories_array = $request->input('category_id');
                $items_array = $request->input('item_id');
                $prices_array = $request->input('price');
                $item_qtys_array = $request->input('item_qty');
                $item_amounts_array = $request->input('item_amount');

                foreach ($categories_array as $key_category => $value_category) {
                    $transaction_items[$key_category]->category_id = $value_category;
                }
            
                foreach ($items_array as $key_item => $value_item) {
                    $transaction_items[$key_item]->item_id = $value_item;
                }

                foreach ($prices_array as $key_price => $value_price) {
                    $transaction_items[$key_price]->item_price = $value_price;
                }

                foreach ($item_qtys_array as $key_qty => $value_qty) {
                    $transaction_items[$key_qty]->item_qty = $value_qty;
                    $total_item_qty += $value_qty;
                }

                foreach ($item_amounts_array as $key_amt => $value_amt) {
                    $transaction_items[$key_amt]->item_amt = $value_amt;
                }

                DB::beginTransaction();
                try {
                    $paramObj->total_item_qty = $total_item_qty;
                    $paramObj->sub_total = $sub_total;
                    $paramObj->service_charges = $service_charges;
                    $paramObj->tax_percent = $tax_percent;
                    $paramObj->tax_type = $tax_type;
                    $paramObj->tax_amt = $tax_amt;
                    $paramObj->main_discount_type = $main_discount_type;
                    $paramObj->main_discount_percent = $main_discount_percent;
                    $paramObj->main_discount_value = $main_discount_value;
                    $paramObj->main_discount_amt = $main_discount_amt;
                    $paramObj->total_item_discounts = $total_item_discounts;
                    $paramObj->grand_total = $grand_total;
                    $paramObj->status = 2;
                    $paramObj->due_amt = $due_amt;
                    $paramObj->remark = $remark;

                    // Saving Transaction Header Object
                    $result = $this->repo->create($paramObj);

                    if ($result['laravelStatusCode'] ==  ReturnMessage::OK) {
                        $transaction_item_repo = new TransactionItemRepository();
                        $transaction_payment_repo = new TransactionPaymentRepository();

                        // saving transaction payment
                        $transaction_payment = new TransactionPayment();
                        $table_name_payment = $transaction_payment->getTable();
                        $last_payment_id = Check::getTableIncrementId($table_name_payment, $date);
                        $transaction_payment->id = $last_payment_id;
                        $transaction_payment->transaction_id = $last_transaction_id;
                        $transaction_payment->status = 1;
                        $transaction_payment->date = $date;
                        $transaction_payment->payment_type = $payment_type;
                        $transaction_payment->paid_amt = $paid_amt;
                        $transaction_payment->change_amt = $change_amt;
                        $transaction_payment->remark = $payment_remark;

                        // store transaction payment
                        $result_payment = $transaction_payment_repo->create($transaction_payment);

                        if ($result_payment['laravelStatusCode'] !=  ReturnMessage::OK) {
                            DB::rollBack();
                            if ($request->ajax()) {
                                return response()->json(['fail'=>'Fail, Transaction Payment is not created at detail table saving ...']);
                            }
                            else{
                                return redirect()->action('Setup\Transaction\TransactionController@index')
                                    ->with(FormatGenerator::message('Fail', 'Transaction Payment is not created at detail table saving ...'));
                            }
                        }

                        // saving all transaction item cases
                        foreach ($transaction_items as $key_tran_item => $transaction_item) {
                            $discount_type = 0;
                            $discount_percent = 0;
                            $discount_amt = 0;
                            $sub_total_amt = $transaction_item->item_amt - $discount_amt;
                        
                            $table_name2 = $transaction_item->getTable();
                            $last_tran_item_id = Check::getTableIncrementId($table_name2, $date);
                            $transaction_item->id = $last_tran_item_id;
                            $transaction_item->discount_type = $discount_type;
                            $transaction_item->discount_percent = $discount_percent;
                            $transaction_item->discount_amt = $discount_amt;
                            $transaction_item->sub_total_amt = $sub_total_amt;

                            // store transaction item
                            $result_item = $transaction_item_repo->create($transaction_item);

                            if ($result_item['laravelStatusCode'] !=  ReturnMessage::OK) {
                                DB::rollBack();
                                if ($request->ajax()) {
                                    return response()->json(['fail'=>'Fail, Transaction Item is not created at detail table saving ...']);
                                }
                                else{
                                    return redirect()->action('Setup\Transaction\TransactionController@index')
                                        ->with(FormatGenerator::message('Fail', 'Transaction Item is not created at detail table saving ...'));
                                }
                            }
                        }

                        DB::commit();
                        if ($request->ajax()) {
                            return response()->json([
                                'success'=>'Success, successfully created transaction.',
                                'obj'=>$paramObj,                                
                                ]);
                        }
                        else{
                            return redirect()->action('Setup\Transaction\TransactionController@index')
                                ->with(FormatGenerator::message('Success', 'Transaction is created ...'));
                        }

                        
                    } else {
                        DB::rollBack();
                        if ($request->ajax()) {
                            return response()->json(['fail'=>'Fail, Transaction is not created at header table saving ...']);
                        }
                        else{
                            return redirect()->action('Setup\Transaction\TransactionController@index')
                                ->with(FormatGenerator::message('Fail', 'Transaction is not created at header table saving ...'));
                        }
                    }
                } catch (Exception $e) {
                    DB::rollBack();
                    if ($request->ajax()) {
                        return response()->json(['fail'=>'Fail, Transaction is not created and got exception.']);
                    }
                    else{
                        return redirect()->action('Setup\Transaction\TransactionController@index')
                            ->with(FormatGenerator::message('Fail', 'Transaction is not created and got exception '));
                    }
                }
                
            }
        

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $obj        = Transaction::find($id);

            $countryRepo = new CountryRepository();
            $countries = $countryRepo->getObjs();

            $userRepo = new UserRepository();
            $customers = $userRepo->getUsersByRoleId(5);

            $categoryRepo = new CategoryRepository();
            $categories = $categoryRepo->getObjs();

            $itemRepo = new ItemRepository();
            $items = $itemRepo->getObjs();

            $townships = Township::query()
                    ->where('city_id', '=', 14) 
                    ->get();

            return view('backend.transaction.transaction')
                        ->with('obj', $obj)
                        ->with('townships', $townships)
                        ->with('countries',$countries)
                        ->with('customers',$customers)
                        ->with('categories',$categories)
                        ->with('items',$items);
        }
        return redirect('/backend_app/login');
    }

    public function update(Request $request){

        $response                           = array();
        $all_input = Input::all();
        $id                         = Input::get('id');

        $rules = [
            'total_item_qty'     => 'required|integer',
            'name'     => 'required',
            'phone'     => 'required',
         ];       

        $messages = [
            'total_item_qty.required'    => '* Air-Con Quantity is required !',
            'name.required'    => '* Order Person Name is required !',
            'phone.required'    => '* Order Person Phone is required !',
        ];

        $validator = Validator::make($all_input, $rules, $messages);
        if ($validator->fails()) {
            return redirect('/backend_app/transaction/edit/' . $id)
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $total_item_qty = trim(Input::get('total_item_qty'));
        $item_id = trim(Input::get('item_id'));
        $add_installation = trim(Input::get('add_installation'));
        $name = trim(Input::get('name'));
        $phone = trim(Input::get('phone'));         
        $date = date('Y-m-d');
        $address = trim(Input::get('address')); 
        $township_id = trim(Input::get('township_id')); 
        $remark = trim(Input::get('remark')); 
        $status = trim(Input::get('status'));

        $paramObj = Transaction::find($id);
        $paramObj->name = $name;
        $paramObj->phone = $phone;
        $paramObj->total_item_qty = $total_item_qty;
        $paramObj->add_installation = $add_installation;
        $paramObj->address = $address;
        $paramObj->township_id = $township_id;
        $paramObj->remark = $remark;
        $paramObj->status = $status;
        
        $result = $this->repo->update($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\Transaction\TransactionController@index')
                ->with(FormatGenerator::message('Success', 'Transaction is updated ...'));
        }
        else{

            return redirect()->action('Setup\Transaction\TransactionController@index')
                ->with(FormatGenerator::message('Fail', 'Transaction is not updated ...'));
        }
    }

    public function destroy(){

        
    }

    public function check_product_name(){
        $product_name     = Input::get('product_name');
        $country_id    = Input::get('country_id');
        $Transaction          = Transaction::where('country_id','=',$country_id)->where('product_name','=',$product_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($Transaction) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
