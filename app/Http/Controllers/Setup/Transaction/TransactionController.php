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
use App\Core\Status As Status;
use App\Core\Check;

use Illuminate\Support\Facades\Validator;
use App\Sample;
use App\Setup\Township\Township;
use App\Setup\Category\CategoryRepository;
use App\Setup\Item\ItemRepository;
use App\Setup\Brand\BrandRepository;

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

            $brandRepo = new BrandRepository();
            $brands = $brandRepo->getObjs();

            $itemRepo = new ItemRepository();
            $items = $itemRepo->getObjs();

            $obj = new Transaction();

            return view('backend.transaction.transaction')
                        ->with('countries',$countries)
                        ->with('customers',$customers)
                        ->with('categories',$categories)
                        ->with('items',$items)
                        ->with('brands',$brands);
                            
        }
        return redirect('/');
    }

    public function store(Request $request){       
            
            $rules = [];
            $rules["customer_id"] = 'required';
            $custom_inputs = array();
            $custom_inputs['customer_id'] = $request->input('customer_id');

            $input_category_ids = $request->input('category_id');
            $input_brand_ids = $request->input('brand_id');
            $input_item_ids = $request->input('item_id');
            $input_item_qtys = $request->input('item_qty');
            $input_prices = $request->input('price');
        
            foreach ($input_category_ids as $key => $value) {
                $custom_inputs['category_id' . $key] = $value;
                $rules["category_id".$key] = 'required';
            }

            foreach($input_brand_ids as $key => $balue){
                $custom_inputs['brand_id' . $key] = $value;
                $rules["brand_id" . $key] = 'required';
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
                $bank_reference = $request->input('bank_reference');
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
                $brands_array = $request->input('brand_id');
                $items_array = $request->input('item_id');
                $prices_array = $request->input('price');
                $item_qtys_array = $request->input('item_qty');
                $item_amounts_array = $request->input('item_amount');

                foreach ($categories_array as $key_category => $value_category) {
                    $transaction_items[$key_category]->category_id = $value_category;
                }

                foreach ($brands_array as $key_brand => $value_brand) {
                    $transaction_items[$key_brand]->brand_id = $value_brand;
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
                    $paramObj->status = Status::TRANSACTION_CONFIRM;
                    
                    $paramObj->due_amt = $due_amt;
                    $paramObj->remark = $remark;
                    // start - saving payment when paid_amt greater than zero and not equal to null
                    if ($paid_amt > 0 && $paid_amt <> null) {
                        if($paid_amt >= $grand_total){
                            $paramObj->paid_amt = $grand_total;
                            $paramObj->status_payment = Status::TRANSACTION_PAYMENT_COMPLETED;
                        }
                        else{
                            $paramObj->paid_amt = $paid_amt;
                            $paramObj->status_payment = Status::TRANSACTION_PAYMENT_IN_PROGRESS;
                        }
                    }
                    else{
                        $paramObj->paid_amt = 0;
                        $paramObj->status_payment = Status::TRANSACTION_PAYMENT_NOT_STARTED_YET;
                    }

                    // Saving Transaction Header Object
                    $result = $this->repo->create($paramObj);

                    if ($result['laravelStatusCode'] ==  ReturnMessage::OK) {
                        
                        // start - saving payment when paid_amt greater than zero and not equal to null
                        if ($paid_amt > 0 && $paid_amt <> null) {
                            $transaction_payment_repo = new TransactionPaymentRepository();

                            // saving transaction payment
                            $transaction_payment = new TransactionPayment();
                            $table_name_payment = $transaction_payment->getTable();
                            $last_payment_id = Check::getTableIncrementId($table_name_payment, $date);
                            $transaction_payment->id = $last_payment_id;
                            $transaction_payment->transaction_id = $last_transaction_id;
                            $transaction_payment->status = Status::TRANSACTION_PAYMENT_DETAIL_CONFIRM;
                            $transaction_payment->date = $date;
                            $transaction_payment->payment_type = $payment_type;
                            $transaction_payment->paid_amt = $paid_amt;
                            $transaction_payment->change_amt = $change_amt;
                            $transaction_payment->remark = $payment_remark;
                            $transaction_payment->bank_reference = $bank_reference;

                            // store transaction payment
                            $result_payment = $transaction_payment_repo->create($transaction_payment);

                            if ($result_payment['laravelStatusCode'] !=  ReturnMessage::OK) {
                                DB::rollBack();
                                if ($request->ajax()) {
                                    return response()->json(['fail'=>'Fail, Transaction Payment is not created at detail table saving ...']);
                                } else {
                                    return redirect()->action('Setup\Transaction\TransactionController@index')
                                    ->with(FormatGenerator::message('Fail', 'Transaction Payment is not created at detail table saving ...'));
                                }
                            }

                        }
                        else{
                            
                            $paramObj->status_payment = Status::TRANSACTION_PAYMENT_NOT_STARTED_YET;
                        }
                        // end - saving payment when paid_amt greater than zero and not equal to null

                        // saving all transaction item cases
                        $transaction_item_repo = new TransactionItemRepository();
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
                            $transaction_item->status = Status::TRANSACTION_ITEM_CONFIRM;

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

    public function edit($id,Request $request)
    {
        if(Auth::check()) {
            $obj        = Transaction::find($id);

            // Checking Oject exist or not case
            if(!isset($obj)){
                if ($request->ajax()) {
                    return response()->json(['fail'=>'Fail, invalid transaction !!! ...']);
                } else {
                    return redirect()->action('Setup\Transaction\TransactionController@index')
                    ->with(FormatGenerator::message('Fail', 'Invalid transaction !!!'));
                }
            }

            $countryRepo = new CountryRepository();
            $countries = $countryRepo->getObjs();

            $userRepo = new UserRepository();
            $customers = $userRepo->getUsersByRoleId(5);

            $categoryRepo = new CategoryRepository();
            $categories = $categoryRepo->getObjs();

            $itemRepo = new ItemRepository();
            $items = $itemRepo->getObjs();

            $brandRepo = new BrandRepository();
            $brands = $brandRepo->getObjs();

            $townships = Township::query()
                    ->where('city_id', '=', 14) 
                    ->get();
                    
            return view('backend.transaction.transaction')
                        ->with('obj', $obj)
                        ->with('townships', $townships)
                        ->with('countries',$countries)
                        ->with('customers',$customers)
                        ->with('categories',$categories)
                        ->with('items',$items)
                        ->with('brands',$brands);
        }
        return redirect('/backend_app/login');
    }

    public function update(Request $request){
            
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
                $bank_reference = $request->input('bank_reference');
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
                    $paramObj->status = Status::TRANSACTION_CONFIRM;
                    $paramObj->due_amt = $due_amt;
                    $paramObj->remark = $remark;

                    // Saving Transaction Header Object
                    $result = $this->repo->create($paramObj);

                    if ($result['laravelStatusCode'] ==  ReturnMessage::OK) {
                        
                        // start - saving payment when paid_amt greater than zero and not equal to null
                        if ($paid_amt > 0 && $paid_amt <> null) {
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
                            $transaction_payment->bank_reference = $bank_reference;
                            $transaction_payment->remark = $payment_remark;

                            // store transaction payment
                            $result_payment = $transaction_payment_repo->create($transaction_payment);

                            if ($result_payment['laravelStatusCode'] !=  ReturnMessage::OK) {
                                DB::rollBack();
                                if ($request->ajax()) {
                                    return response()->json(['fail'=>'Fail, Transaction Payment is not created at detail table saving ...']);
                                } else {
                                    return redirect()->action('Setup\Transaction\TransactionController@index')
                                    ->with(FormatGenerator::message('Fail', 'Transaction Payment is not created at detail table saving ...'));
                                }
                            }

                        }
                        // end - saving payment when paid_amt greater than zero and not equal to null

                        // saving all transaction item cases
                        $transaction_item_repo = new TransactionItemRepository();
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

    public function addPayment(Request $request){

        // for input validation
        $rules = [];
        $rules["transaction_id"] = 'required';
        $rules["paid_amt_payment"] = 'required';
        $request_inputs = $request->all();
        $validator = Validator::make($request_inputs, $rules);
    
        // for validation fail case
        if ($validator->fails()) {

            if ($request->ajax()) {
                
                return response()->json([
                    'fail'=>'Fail, Validation Error',
                    'error'  => $validator->errors()->all()
                ]);
            }
            else{
                return redirect('/backend_app/transaction')
                    ->withErrors($validator)
                    ->withInput();
            }

        } 
        else {
            // for validation success case
            $transaction_id = $request->input('transaction_id');
            $date = date('Y-m-d');
            $payment_type = $request->input('payment_type');
            $paid_amt = $request->input('paid_amt_payment');
            $change_amt = $request->input('change_amt_payment');
            $bank_reference = $request->input('bank_reference'); 
            $payment_remark = $request->input('payment_remark');                
            $due_amt = $request->input('due_amt_payment_new');

            $transaction_payment_repo = new TransactionPaymentRepository();
            $existing_paid_amt = $transaction_payment_repo->getTotalPaidAmtByTransactionId($transaction_id);

            $paramObj = Transaction::find($transaction_id);
            $existing_paid_amt = $paramObj->paid_amt;
            $existing_due_amt = $paramObj->due_amt;

            $paid_amt_raw = $existing_paid_amt + $paid_amt;
            if($paid_amt_raw >= $paramObj->grand_total){
                $paramObj->paid_amt = $paramObj->grand_total;
                $paramObj->status_payment = Status::TRANSACTION_PAYMENT_COMPLETED;
            }
            else{
                $paramObj->status_payment = Status::TRANSACTION_PAYMENT_IN_PROGRESS;
                $paramObj->paid_amt = $existing_paid_amt + $paid_amt;
            }

            $paramObj->due_amt = $due_amt;            

            // checking payment completed or not 
            if($existing_due_amt <= 0){
                if ($request->ajax()) {
                    return response()->json([
                        'success'=>'Warning, this is a payment completed transaction !!! ',
                        'obj'=>$paramObj,                                
                        ]);
                }
                else{
                    return redirect()->action('Setup\Transaction\TransactionController@index')
                        ->with(FormatGenerator::message('Warning, this is a payment completed transaction !!! '));
                }

            }

            DB::beginTransaction();
            try {
                // Updating Transaction Header Object
                $result = $this->repo->update($paramObj);

                if ($result['laravelStatusCode'] ==  ReturnMessage::OK) {
                    
                    // start - saving new payment for existing transaction 
                    if ($paid_amt > 0 && $paid_amt <> null) {

                        // saving transaction payment
                        $transaction_payment = new TransactionPayment();
                        $table_name_payment = $transaction_payment->getTable();
                        $last_payment_id = Check::getTableIncrementId($table_name_payment, $date);
                        $transaction_payment->id = $last_payment_id;
                        $transaction_payment->transaction_id = $transaction_id;
                        $transaction_payment->status = 1;
                        $transaction_payment->date = $date;
                        $transaction_payment->payment_type = $payment_type;
                        $transaction_payment->paid_amt = $paid_amt;
                        $transaction_payment->change_amt = $change_amt;
                        $transaction_payment->bank_reference = $bank_reference;
                        $transaction_payment->remark = $payment_remark;

                        // store transaction payment
                        $result_payment = $transaction_payment_repo->create($transaction_payment);

                        if ($result_payment['laravelStatusCode'] !=  ReturnMessage::OK) {
                            DB::rollBack();
                            if ($request->ajax()) {
                                return response()->json(['fail'=>'Fail, Transaction Payment is not created at detail table saving ...']);
                            } else {
                                return redirect()->action('Setup\Transaction\TransactionController@index')
                                ->with(FormatGenerator::message('Fail', 'Transaction Payment is not created at detail table saving ...'));
                            }
                        }

                        DB::commit();
                        if ($request->ajax()) {
                            return response()->json([
                                'success'=>'Success, payment submittted successfully.',
                                'obj'=>$paramObj,                                
                                ]);
                        }
                        else{
                            return redirect()->action('Setup\Transaction\TransactionController@index')
                                ->with(FormatGenerator::message('Success', 'new payment submittted successfully ...'));
                        }

                    }
                    else{
                        DB::rollBack();
                        if ($request->ajax()) {
                            return response()->json(['fail'=>'Fail, Invalid Pay amount ...']);
                        } else {
                            return redirect()->action('Setup\Transaction\TransactionController@index')
                            ->with(FormatGenerator::message('Fail', 'Fail, Invalid Pay amount ...'));
                        }
                    }

                    // end - saving payment when paid_amt greater than zero and not equal to null                        

                    
                } 
                else {
                    DB::rollBack();
                    if ($request->ajax()) {
                        return response()->json(['fail'=>'Fail, Transaction can not update at header Table while adding new payment ...']);
                    } else {
                        return redirect()->action('Setup\Transaction\TransactionController@index')
                        ->with(FormatGenerator::message('Fail', 'Fail, Transaction can not update at header Table while adding new payment ...'));
                    }
                }

            } catch (Exception $e) {
                DB::rollBack();
                if ($request->ajax()) {
                    return response()->json(['fail'=>'Fail, New Payment can not submitted and got exception.']);
                }
                else{
                    return redirect()->action('Setup\Transaction\TransactionController@index')
                        ->with(FormatGenerator::message('Fail', 'New Payment can not submitted and got exception.'));
                }
            }
            
        }

        // for unexpected case 
        return response()->json(['error'=>$validator->errors()->all()]);
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
