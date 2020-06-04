<?php

namespace App\Http\Controllers\Setup\ExpenseType;

use App\Core\Utility;
use App\Setup\ExpenseType\ExpenseTypeRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ExpenseTypeEntryRequest;
use App\Backend\Infrastructure\Forms\ExpenseTypeEditRequest;
use App\Setup\ExpenseType\ExpenseTypeRepositoryInterface;
use App\Setup\ExpenseType\ExpenseType;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Check;
use image;

class ExpenseTypeController extends Controller
{
    private $repo;

    public function __construct(ExpenseTypeRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if(Auth::check()) {
            $expense_types      = $this->repo->getObjsAll();
            return view('backend.expense_type.index')->with('expense_types',$expense_types);
        }
        return redirect('/');
    }

    public function create()
    {
        if(Auth::check()) {
            return view('backend.expense_type.expense_type')
                        ->with('action_type', 'create');
        }
        return redirect('/');
    }

    public function store(ExpenseTypeEntryRequest $request)
    {
        
        $validated                      = $request->validated();        
        $expense_type_name                      = Input::get('name');
        $code                           = Input::get('code');
        $image_url_name                 = "";
        $description                    = Input::get('description');
        $remark                         = Input::get('remark');
        $status                         = Input::get('status');

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path         = base_path().'/public/images/expense_type/';

        if(Input::hasFile('image_url'))
        {
            $image_url        = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext      = Utility::getImageExt($image_url);
            $image_url_name     = uniqid() . "." . $image_url_ext;
            $image          = Utility::resizeImage($image_url,$image_url_name,$path);
        }
        else{
            $image_url_name = "";
        }

        if($removeImageFlag == 1){
            $image_url_name = "";
        }
        //End Saving Image

        $paramObj = new ExpenseType();
        $paramObj->name         = $expense_type_name;
        $paramObj->code         = $code;
        $paramObj->image_url    = '/images/expense_type/' . $image_url_name;
        $paramObj->description  = $description;
        $paramObj->remark       = $remark;
        $paramObj->status       = $status;

        $result = $this->repo->create($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            return redirect()->action('Setup\ExpenseType\ExpenseTypeController@index')
                ->with(FormatGenerator::message('Success', 'ExpenseType is created ...'));
        }
        else{
            return redirect()->action('Setup\ExpenseType\ExpenseTypeController@index')
                ->with(FormatGenerator::message('Fail', 'ExpenseType is not created ...'));
        }

    }

    public function show($id)
    {
        if(Auth::check()) {
            $expense_type        = ExpenseType::find($id);
            return view('backend.expense_type.expense_type')
                    ->with('obj', $expense_type)
                    ->with('action_type', 'show');
        }
        return redirect('/backend_app/login');
    }

    public function edit($id)
    {
        if(Auth::check()) {
            $expense_type        = ExpenseType::find($id);
            return view('backend.expense_type.expense_type')
                    ->with('obj', $expense_type)
                    ->with('action_type', 'edit');
        }
        return redirect('/backend_app/login');
    }

    public function update(ExpenseTypeEditRequest $request){
        
        $validated                      = $request->validated();
        $id                             = Input::get('id');
        $expense_type_name                      = Input::get('name');
        $code                           = Input::get('code');
        $description                    = Input::get('description');
        $remark                         = Input::get('remark');
        $status                         = Input::get('status');
        
        $removeImageFlag                = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path                           = base_path().'/public/images/expense_type/';        
        $remove_old_image               = false;

        $paramObj                       = ExpenseType::find($id);
        $old_image                      = $paramObj->image_url;
        $paramObj->name                 = $expense_type_name;
        $paramObj->code                 = $code;
        $paramObj->description          = $description;
        $paramObj->remark               = $remark;
        $paramObj->status               = $status;

        if(Input::hasFile('image_url'))
        {   
            //Start Saving Image
            $image_url                  = Input::file('image_url');
            $image_url_name_original    = Utility::getImage($image_url);
            $image_url_ext              = Utility::getImageExt($image_url);
            $image_url_name             = uniqid() . "." . $image_url_ext;
            $image                      = Utility::resizeImage($image_url,$image_url_name,$path);
            $remove_old_image           = true;
            $paramObj->image_url        = '/images/expense_type/' . $image_url_name;
            //End Saving Image
        }
        else{
            if($removeImageFlag == 1){
                $paramObj->image_url    = "";
                $remove_old_image       = true;
            }
        }

        $result = $this->repo->update($paramObj);
        if($result['laravelStatusCode'] ==  ReturnMessage::OK){

            // Delete the old image
            if($remove_old_image           == true){
                Utility::removeImage($old_image);
            }            

            return redirect()->action('Setup\ExpenseType\ExpenseTypeController@index')
                ->with(FormatGenerator::message('Success', 'ExpenseType is updated ...'));
        }
        else{

            return redirect()->action('Setup\ExpenseType\ExpenseTypeController@index')
                ->with(FormatGenerator::message('Fail', 'ExpenseType is not updated ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\ExpenseType\ExpenseTypeController@index')
                ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));        
    }

    public function enable(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\ExpenseType\ExpenseTypeController@index')
                ->with(FormatGenerator::message('Success', 'activated successfully   !!!'));  
    }

    public function check_expense_type_name(){
        $expense_type_name     = Input::get('expense_type_name');
        $expense_type_id    = Input::get('expense_type_id');
        $expense_type          = ExpenseType::where('expense_type_id','=',$expense_type_id)->where('expense_type_name','=',$expense_type_name)->whereNull('deleted_at')->get();
        $result        = false;
        if(count($expense_type) == 0 ){
            $result = true;
        }

        return \Response::json($result);
    }

}
