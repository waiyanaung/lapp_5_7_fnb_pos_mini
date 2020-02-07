<?php

namespace App\Http\Controllers\Setup\TransactionOrder;

use App\Core\Utility;
use App\Setup\Country\CountryRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ProductEntryRequest;
use App\Backend\Infrastructure\Forms\ProductEditRequest;
use App\Setup\TransactionOrder\TransactionOrderRepositoryInterface;
use App\Setup\TransactionOrder\TransactionOrder;
use App\Setup\Country\Country;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;

use Illuminate\Support\Facades\Validator;
use App\Setup\Township\Township;

class TransactionOrderController extends Controller
{
    private $repo;

    public function __construct(TransactionOrderRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
        $objs      = $this->repo->getObjsByLastCreated();
            return view('backend.transaction_order.index')->with('objs',$objs);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            $countryRepo = new CountryRepository();
            $countries = $countryRepo->getObjs();
            return view('backend.transaction_order.TransactionOrder')->with('countries',$countries);
        }
        return redirect('/');
    }

    public function store(ProductEntryRequest $request)
    {
        $validated = $request->validated();
        $product_name       = Input::get('name');
        $country_id      = Input::get('country_id');
        $code            = Input::get('code');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/upload/';

        if(Input::hasFile('photo'))
        {
            $photo        = Input::file('photo');
            $photo_name_original    = Utility::getImage($photo);
            $photo_ext      = Utility::getImageExt($photo);
            $photo_name     = uniqid() . "." . $photo_ext;
            $image          = Utility::resizeImage($photo,$photo_name,$path);
        }
        else{
            $photo_name = "";
        }

        if($removeImageFlag == 1){
            $photo_name = "";
        }
        //End Saving Image

        $paramObj = new TransactionOrder();
        $paramObj->name         = $product_name;
        $paramObj->country_id   = $country_id;
        $paramObj->code         = $code;
        $paramObj->image        = $photo_name;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\TransactionOrder\TransactionOrderController@index')
                ->with(FormatGenerator::message('Success', 'TransactionOrder is created ...'));
        }
        else{
            return redirect()->action('Setup\TransactionOrder\TransactionOrderController@index')
                ->with(FormatGenerator::message('Fail', 'TransactionOrder is not created ...'));
        }

    }

    public function edit($id)
    {
        if(Auth::check()) {
            $obj        = TransactionOrder::find($id);

            $countryRepo = new CountryRepository();
            $countries   = $countryRepo->getObjs();

            $townships = Township::query()
                    ->where('city_id', '=', 14) 
                    ->get();

            return view('backend.transaction_order.transaction_order')
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
            return redirect('/backend_app/transaction_order/edit/' . $id)
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

        $paramObj = TransactionOrder::find($id);
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

            return redirect()->action('Setup\TransactionOrder\TransactionOrderController@index')
                ->with(FormatGenerator::message('Success', 'TransactionOrder is updated ...'));
        }
        else{

            return redirect()->action('Setup\TransactionOrder\TransactionOrderController@index')
                ->with(FormatGenerator::message('Fail', 'TransactionOrder is not updated ...'));
        }
    }

    public function destroy(){

        
    }

    public function check_product_name(){
        $product_name     = Input::get('product_name');
        $country_id    = Input::get('country_id');
        $TransactionOrder          = TransactionOrder::where('country_id','=',$country_id)->where('product_name','=',$product_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($TransactionOrder) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
