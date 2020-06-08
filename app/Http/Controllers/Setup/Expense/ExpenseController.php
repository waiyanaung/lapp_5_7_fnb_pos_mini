<?php

namespace App\Http\Controllers\Setup\Expense;

use App\Backend\Infrastructure\Forms\ExpenseEditRequest;
use App\Backend\Infrastructure\Forms\ExpenseEntryRequest;
use App\Core\Check;
use App\Core\FormatGenerator as FormatGenerator;
use App\Core\ReturnMessage as ReturnMessage;
use App\Core\Utility AS Utility;
use App\Http\Controllers\Controller;
use App\Setup\Category\CategoryRepository;
use App\Setup\Expense\Expense;
use App\Setup\Expense\ExpenseRepositoryInterface;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Setup\Country\CountryRepository;
use App\Setup\Brand\BrandRepository;
use App\Setup\ExpenseType\ExpenseTypeRepository;

class ExpenseController extends Controller
{
    private $repo;

    public function __construct(ExpenseRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if($request->ajax()){

            $returnedObj['laravelStatus'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['laravelStatusMessage'] = "fail";
            $returnedObj['ojbs'] = array();

            if (Auth::check()) {
                $expenses = $this->repo->getObjsAllByLastExpenseFilter();
                $categoryRepo = new CategoryRepository();
                $categories = $categoryRepo->getObjs();
    
                $countryRepo = new CountryRepository();
                $countries = $countryRepo->getObjs();
    
                $brand_repo = new BrandRepository();
                $brands = $brand_repo->getObjs();
                
                $returnedObj['laravelStatus'] = ReturnMessage::OK;
                $returnedObj['laravelStatusMessage'] = "Success";
                $expenses =  '
                <option value="1">Aungmyethazan</option>
                <option value="2">Chanayethazan</option>
                <option value="3">Chanmyathazi</option>
                <option value="4">Maha Aungmye</option>
                ';;
                $returnedObj['ojbs'] = $expenses;

                return response()->json(array('returnedObj'=> $returnedObj), 500);
            }
            return response()->json(array('returnedObj'=> $returnedObj), 500);
        }
        else{
            if (Auth::check()) {
                $expenses = $this->repo->getObjsAllByLastExpenseFilter();
                $currency_types = Utility::getCoreSettingsByType('CURRENCY');
                
                return view('backend.expense.index')
                    ->with('objs', $expenses)
                    ->with('currency_types', $currency_types);
            }
            return redirect('/');
        }
        
    }

    public function getExpenses(Request $request)
    {

        if($request->ajax()){
            $inputs = Input::all();
            $filter = isset($inputs['filter']) ? $inputs['filter'] : null;
            $category_id = isset($inputs['category_id']) ? $inputs['category_id'] : null;
            $brand_id = isset($inputs['brand_id']) ? $inputs['brand_id'] : null;
            $returnedObj['laravelStatus'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['laravelStatusMessage'] = "fail";
            $returnedObj['objs'] = "";
            $expense_list = "";

            if (Auth::check()) {

                // searching all expenses case
                if($filter == null){
                    $expenses = $this->repo->getObjsAllByLastExpenseFilter();
                }
                else{

                    // searching expenses by category case
                    if($filter == "category"){
                        $expenses = $this->repo->getExpenseByCategoryId($category_id);
                    }

                     // searching expenses by brand case
                    else if ($filter == "brand"){
                        $expenses = $this->repo->getExpenseByBrandId($brand_id);
                    }
                    
                    // all expenses case for exception case
                    else{
                        $expenses = $this->repo->getObjsAllByLastExpenseFilter();
                    }
                    
                }

                if(isset($expenses) && count($expenses)>0){
                    $expense_list .= '<option value="" selected>Select Expense</option>';
                    foreach($expenses as $expense){
                        $expense_list .= '<option value="'. $expense->id .'">'. $expense->name .'</option>';
                    }
                }
                
                $returnedObj['laravelStatus'] = ReturnMessage::OK;
                $returnedObj['laravelStatusMessage'] = "Success";                
                $returnedObj['objs'] = $expense_list;
                return response()->json(array('returnedObj'=> $returnedObj), 200);
            }
            return response()->json(array('returnedObj'=> $returnedObj), 500);
        }
        else{
            if (Auth::check()) {
                $expenses = $this->repo->getObjsAllByLastExpenseFilter();
                $categoryRepo = new CategoryRepository();
                $categories = $categoryRepo->getObjs();
    
                $countryRepo = new CountryRepository();
                $countries = $countryRepo->getObjs();
    
                $brand_repo = new BrandRepository();
                $brands = $brand_repo->getObjs();
                
                return view('backend.expense.index')
                    ->with('objs', $expenses)
                    ->with('brands', $brands)
                    ->with('countries', $countries)
                    ->with('categories', $categories);
            }
            return redirect('/');
        }
        
    }

    public function getExpense(Request $request)
    {

        if($request->ajax()){
            $expense_id = Input::get('expense_id');;
            $returnedObj['laravelStatus'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            $returnedObj['laravelStatusMessage'] = "fail";
            $returnedObj['objs'] = "";
            $expense_list = "";

            if (Auth::check()) {
                if($expense_id == null){
                    return response()->json(array('returnedObj'=> $returnedObj), 500);
                }
                else{
                    $expense = $this->repo->getExpenseById($expense_id);
                }

                if(isset($expense) && count($expense)>0){
                    $returnedObj['laravelStatus'] = ReturnMessage::OK;
                    $returnedObj['laravelStatusMessage'] = "Success";                
                    $returnedObj['objs'] = $expense;
                }
                else{
                    $returnedObj['laravelStatusMessage'] = "Fail, There is no expense about this id!";                
                    $returnedObj['objs'] = $expense_list;
                }                
                
                return response()->json(array('returnedObj'=> $returnedObj), 200);
            }
            return response()->json(array('returnedObj'=> $returnedObj), 500);
        }
        else{
            if (Auth::check()) {
                $expenses = $this->repo->getObjsAllByLastExpenseFilter();
                $categoryRepo = new CategoryRepository();
                $categories = $categoryRepo->getObjs();
    
                $countryRepo = new CountryRepository();
                $countries = $countryRepo->getObjs();
    
                $brand_repo = new BrandRepository();
                $brands = $brand_repo->getObjs();
                
                return view('backend.expense.index')
                    ->with('objs', $expenses)
                    ->with('brands', $brands)
                    ->with('countries', $countries)
                    ->with('categories', $categories);
            }
            return redirect('/');
        }
        
    }

    public function create()
    {
        if (Auth::check()) {
            $expense_type_repo = new ExpenseTypeRepository();
            $expense_types = $expense_type_repo->getObjs();

            $currency_types = Utility::getCoreSettingsByType('CURRENCY');
            
            return view('backend.expense.expense')                
                ->with('expense_types', $expense_types)
                ->with('currency_types', $currency_types)
                ->with('action_type', 'create');
        }
        return redirect('/');
    }

    public function store(ExpenseEntryRequest $request)
    {
        try{
            $validated = $request->validated();
            $name = Input::get('name');
            $date = Input::get('date');
            $status = Input::get('status');
            $expense_type_id = Input::get('expense_type_id');
            $currency_id = Input::get('currency_id');
            $amount = Input::get('amount');
            $description = Input::get('description');
            $remark = Input::get('remark');

            $image_url_name = "";
            //Start Saving Image
            $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
            $path = base_path() . '/public/images/expense/';

            if (Input::hasFile('image_url')) {
                $image_url = Input::file('image_url');
                $image_url_name_original = Utility::getImage($image_url);
                $image_url_ext = Utility::getImageExt($image_url);
                $image_url_name = uniqid() . "." . $image_url_ext;
                $image = Utility::resizeImage($image_url, $image_url_name, $path);
            } else {
                $image_url_name = "";
            }

            if ($removeImageFlag == 1) {
                $image_url_name = "";
            }
            //End Saving Image 1

            //Start Saving Image
            $removeImageFlag1 = (Input::has('removeImageFlag1')) ? Input::get('removeImageFlag1') : 0;
            $path1 = base_path() . '/public/images/expense/';

            if (Input::hasFile('image_url1')) {
                $image_url1 = Input::file('image_url1');
                $image_url_name_original1 = Utility::getImage($image_url1);
                $image_url_ext1 = Utility::getImageExt($image_url1);
                $image_url_name1 = uniqid() . "." . $image_url_ext1;
                $image1 = Utility::resizeImage($image_url1, $image_url_name1, $path1);
            } else {
                $image_url_name1 = "";
            }

            if ($removeImageFlag1 == 1) {
                $image_url_name1 = "";
            }
            //End Saving Image 1

            $paramObj = new Expense();

            $table_name = $paramObj->getTable();
            $date_today = date('Y-m-d');
            $last_id = Check::getTableIncrementId($table_name, $date_today);

            $paramObj->id = $last_id;
            $paramObj->name = $name;
            $paramObj->date = $date;
            $paramObj->status = $status;
            $paramObj->expense_type_id = $expense_type_id;
            $paramObj->currency_id = $currency_id;
            $paramObj->amount = $amount;            
            $paramObj->description = $description;
            $paramObj->remark = $remark;
            $paramObj->image_url = '/images/expense/' . $image_url_name;
            $paramObj->image_url1 = '/images/expense/' . $image_url_name1;        

            $result = $this->repo->create($paramObj);
            if ($result['laravelStatusCode'] == ReturnMessage::OK) {

                return redirect()->action('Setup\Expense\ExpenseController@index')
                    ->with(FormatGenerator::message('Success', 'Expense is created ...'));
            } else {
               
                return redirect()->action('Setup\Expense\ExpenseController@index')
                    ->with(FormatGenerator::message('Fail', 'Expense is not created ...'));
            }
        }
        catch(Exception $e){
            return redirect()->action('Setup\Expense\ExpenseController@index')
                    ->with(FormatGenerator::message('Fail', 'There is an unexpected error while creating expense. Please connect to Site Admin and sorry for error ... '));
        }

    }

    public function show($id)
    {
        if (Auth::check()) {
            $expense = Expense::find($id);
            $expense_type_repo = new ExpenseTypeRepository();
            $expense_types = $expense_type_repo->getObjs();

            $currency_types = Utility::getCoreSettingsByType('CURRENCY');
            
            return view('backend.expense.expense')
                ->with('obj', $expense)
                ->with('expense_types', $expense_types)
                ->with('currency_types', $currency_types)
                ->with('action_type', 'show');
        }
        return redirect('/backend_app/login');
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $expense = Expense::find($id);
            $expense_type_repo = new ExpenseTypeRepository();
            $expense_types = $expense_type_repo->getObjs();

            $currency_types = Utility::getCoreSettingsByType('CURRENCY');

            return view('backend.expense.expense')
                ->with('obj', $expense)
                ->with('expense_types', $expense_types)
                ->with('currency_types', $currency_types)
                ->with('action_type', 'edit');
        }
        return redirect('/backend_app/login');
    }

    public function update(ExpenseEditRequest $request)
    {
        $validated = $request->validated();
        $id = Input::get('id');
        $name = Input::get('name');
        $date = Input::get('date');
        $status = Input::get('status');
        $expense_type_id = Input::get('expense_type_id');
        $currency_id = Input::get('currency_id');
        $amount = Input::get('amount');
        $description = Input::get('description');
        $remark = Input::get('remark');

        $removeImageFlag = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $path = base_path() . '/public/images/expense/';
        $remove_old_image = false;

        $removeImageFlag1 = (Input::has('removeImageFlag1')) ? Input::get('removeImageFlag1') : 0;
        $path1 = base_path() . '/public/images/expense/';
        $remove_old_image1 = false;

        $paramObj = Expense::find($id);
        $paramObj->name = $name;
        $paramObj->date = $date;
        $paramObj->status = $status;
        $paramObj->expense_type_id = $expense_type_id;
        $paramObj->currency_id = $currency_id;
        $paramObj->amount = $amount;            
        $paramObj->description = $description;
        $paramObj->remark = $remark;
        $old_image = $paramObj->image_url;
        $old_image1 = $paramObj->image_url1;
       
        if (Input::hasFile('image_url')) {
            //Start Saving Image
            $image_url = Input::file('image_url');
            $image_url_name_original = Utility::getImage($image_url);
            $image_url_ext = Utility::getImageExt($image_url);
            $image_url_name = uniqid() . "." . $image_url_ext;
            $image = Utility::resizeImage($image_url, $image_url_name, $path);
            $remove_old_image = true;
            $paramObj->image_url = '/images/expense/' . $image_url_name;
            //End Saving Image
        } else {
            if ($removeImageFlag == 1) {
                $paramObj->image_url = "";
                $remove_old_image = true;
            }
        }

        if (Input::hasFile('image_url1')) {
            //Start Saving Image 1
            $image_url1 = Input::file('image_url1');
            $image_url_name_original1 = Utility::getImage($image_url1);
            $image_url_ext1 = Utility::getImageExt($image_url1);
            $image_url_name1 = uniqid() . "." . $image_url_ext1;
            $image1 = Utility::resizeImage($image_url1, $image_url_name1, $path1);
            $remove_old_image1 = true;
            $paramObj->image_url1 = '/images/expense/' . $image_url_name1;
            //End Saving Image 1
        } else {
            if ($removeImageFlag1 == 1) {
                $paramObj->image_url1 = "";
                $remove_old_image1 = true;
            }
        }
            
        $result = $this->repo->update($paramObj);
        if ($result['laravelStatusCode'] == ReturnMessage::OK) {

            // Delete the old image
            if ($remove_old_image == true) {
                Utility::removeImage($old_image);
            }

            // Delete the old image 1
            if ($remove_old_image1 == true) {
                Utility::removeImage($old_image1);
            }

            return redirect()->action('Setup\Expense\ExpenseController@index')
                ->with(FormatGenerator::message('Success', 'Expense is updated ...'));
        } else {

            return redirect()->action('Setup\Expense\ExpenseController@index')
                ->with(FormatGenerator::message('Fail', 'Expense is not updated ...'));
        }
    }

    public function destroy()
    {
        $id = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach ($new_string as $id) {
            $this->repo->delete($id);
        }
        return redirect()->action('Setup\Expense\ExpenseController@index')
            ->with(FormatGenerator::message('Success', 'de-activated successfully   ...'));
    }

    public function enable()
    {
        $id = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach ($new_string as $id) {
            $this->repo->activate($id);
        }
        return redirect()->action('Setup\Expense\ExpenseController@index')
            ->with(FormatGenerator::message('Success', 'activated successfully   ...'));
    }

    public function check_expense_name()
    {
        $expense_name = Input::get('expense_name');
        $country_id = Input::get('country_id');
        $expense = Expense::where('country_id', '=', $country_id)->where('expense_name', '=', $expense_name)->whereNull('deleted_at')->get();
        $result = false;
        if (count($expense) == 0) {
            $result = true;
        }

        return \Response::json($result);
    }

}
