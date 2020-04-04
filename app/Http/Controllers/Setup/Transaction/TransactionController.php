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
        

        $response                           = array();
        $all_input = Input::all();
        $customer_id = Input::get('customer_id');
        $date = date('Y-m-d');

        if($request->ajax()){
            return redirect('/backend_app/transaction/create');
        }

        $rules = [
            'customer_id'     => 'required'
         ];       

        $messages = [
            'name.required'    => '* Customer Name is required !'
        ];

        foreach($request->input('name') as $key => $value) {
            $rules["name.{$key}"] = 'required';
        }

        $validator = Validator::make($all_input, $rules, $messages);

        $countryRepo = new CountryRepository();
        $countries = $countryRepo->getObjs();

        $userRepo = new UserRepository();
        $customers = $userRepo->getUsersByRoleId(5);

        if ($validator->passes()) {
            foreach($request->input('name') as $key => $value) {
                TagList::create(['name'=>$value]);
            }


            return response()->json(['success'=>'done']);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
        
        if ($validator->fails()) {
            return redirect('/backend_app/transaction/create')
                        ->with('countries',$countries)
                        ->with('customers',$customers)
                        ->withErrors($validator)
                        ->withInput();
        }
        
        try{

            
            DB::beginTransaction();
            $paramObj = new Transaction();
            $table_name = $paramObj->getTable();

            $last_id = Check::getTableIncrementId($table_name,$date);
            
            $paramObj = new Transaction();        
            $paramObj->id = $last_id;
            $paramObj->customer_id = $customer_id;
            $paramObj->date = $date;
            
            $res = $this->repo->create($paramObj);

            if($res['laravelStatusCode'] == ReturnMessage::OK){                
                DB::commit();

                return redirect()->action('Setup\Transaction\TransactionController@index')
                ->with(FormatGenerator::message('Success', 'Transaction is created ...'));
            }
            else{
                return redirect()->action('Setup\Transaction\TransactionController@index')
                    ->with(FormatGenerator::message('Fail', 'Transaction is not created ...'));
            }
                       

        }
        catch(\Exception $e){  
            
            DB::rollback();
            return redirect()->action('Setup\Transaction\TransactionController@index')
                    ->with(FormatGenerator::message('Fail', 'Transaction is not created ...'));
        }
    }

    public function edit($id)
    {
        if(Auth::check()) {
            $obj        = Transaction::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjs();

            $townships = Township::query()
                    ->where('city_id', '=', 14) 
                    ->get();

            return view('backend.transaction.transaction')
                        ->with('obj', $obj)
                        ->with('townships', $townships)
                        ->with('countries', $countries);
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
