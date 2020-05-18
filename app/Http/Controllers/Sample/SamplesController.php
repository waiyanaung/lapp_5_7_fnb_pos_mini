<?php

namespace App\Http\Controllers\Sample;

use Illuminate\Http\Request;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use App\Core\User\UserRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Sample;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use App\Setup\Township\Township;
use App\Setup\Category\CategoryRepository;
use App\Setup\Item\ItemRepository;
use App\Setup\Country\Country;
use App\Backend\Infrastructure\Forms\ProductEntryRequest;
use App\Backend\Infrastructure\Forms\ProductEditRequest;
use App\Setup\Transaction\TransactionRepositoryInterface;
use App\Setup\Transaction\Transaction;
use App\Setup\TransactionItem\TransactionItemRepository;
use App\Setup\TransactionItem\TransactionItem;

class SamplesController extends Controller
{
    public function __construct(TransactionRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('sample.googlemap');
    }

    public function getLocations()
    {

        $locations = [
            ['<b>Bondi Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -33.890542, 151.274856, 4],
            ['Coogee Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -33.923036, 151.259052, 5],
            ['Cronulla Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -34.028249, 151.157507, 3],
            ['Manly Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -33.80010128657071, 151.28747820854187, 2],
            ['Maroubra Beach</b><a href="/backend_app/systemreference"><img src="/images/logo.jpg"></a>', -33.950198, 151.259302, 1]
        ];

        return response()->json($locations);
    }

    public function addMore()
    {
        return view("backend.sample.dynamic_form");
    }


    public function addMorePost(Request $request)
    {
        $rules = [];


        foreach($request->input('name') as $key => $value) {
            $rules["name.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator->passes()) {


            foreach($request->input('name') as $key => $value) {
                Sample::create(['name'=>$value]);
            }


            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
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

            return view('backend.sample.dynamic_form2')
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
                
                $customer_id = $request->input('customer_id');
                $date = date('Y-m-d');
                $total_item_qty = 0;
                $total_price = $request->input('total_price');
            
                $service_charges = 0;
                $tax_percent = 0;
                $tax_type = 0;
                $tax_amt = 0;
                $main_discount_type = 0;
                $main_discount_percent = 0;
                $main_discount_amt = 0;
                $total_item_discounts = 0;

                $paramObj = new Transaction();
                $table_name = $paramObj->getTable();
            
                $last_id = Check::getTableIncrementId($table_name, $date);
                $paramObj->id = $last_id;
                $paramObj->customer_id = $customer_id;
                $paramObj->date = $date;

                $transaction_items = array();
                $total_item_count = count($request->input('category_id'));
                for ($i = 0; $i < $total_item_count; $i++) {
                    $transaction_items[$i] = new TransactionItem();
                    $transaction_items[$i]->transaction_id = $last_id;
                    $transaction_items[$i]->date = $date;
                }
            
                $categories_array = $request->input('category_id');
                $items_array = $request->input('item_id');
                $prices_array = $request->input('price');
                $item_qtys_array = $request->input('item_qty');
                $item_amounts_array = $request->input('item_amount');
            
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
                    $paramObj->sub_total = $total_price;
                    $paramObj->service_charges = $service_charges;
                    $paramObj->tax_percent = $tax_percent;
                    $paramObj->tax_type = $tax_type;
                    $paramObj->tax_amt = $tax_amt;
                    $paramObj->main_discount_type = $main_discount_type;
                    $paramObj->main_discount_percent = $main_discount_percent;
                    $paramObj->main_discount_amt = $main_discount_amt;
                    $paramObj->total_item_discounts = $total_item_discounts;
                    $paramObj->status = 2;

                    $total_price = $total_price + $service_charges + $tax_amt;
                    $total_dis_amt = $main_discount_amt + $total_item_discounts;

                    $grand_total = $total_price - $total_dis_amt;
                    $paramObj->grand_total = $grand_total;

                    $result = $this->repo->create($paramObj);
                    // Sample::create(['name'=>$value]);

                    if ($result['laravelStatusCode'] ==  ReturnMessage::OK) {
                        $transaction_item_repo = new TransactionItemRepository();

                        foreach ($transaction_items as $key_tran_item => $transaction_item) {
                            $discount_type = 0;
                            $discount_percent = 0;
                            $discount_amt = 0;
                            $sub_total_amt = $transaction_item->item_amt - $discount_amt;
                        
                            $table_name2 = $transaction_item->getTable();
                            $last_id2 = Check::getTableIncrementId($table_name2, $date);
                            $transaction_item->id = $last_id2;
                            $transaction_item->discount_type = $discount_type;
                            $transaction_item->discount_percent = $discount_percent;
                            $transaction_item->discount_amt = $discount_amt;
                            $transaction_item->sub_total_amt = $sub_total_amt;

                            $result2 = $transaction_item_repo->create($transaction_item);

                            if ($result2['laravelStatusCode'] !=  ReturnMessage::OK) {
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
                            return response()->json(['success'=>'Success, successfully created transaction.']);
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
        

    }
}
