<?php
namespace App\Http\Controllers\Core;

use App\Core\FormatGenerator as FormatGenerator;
use App\Core\Nrc\NrcRepository;
use App\Core\ReturnMessage as ReturnMessage;
use App\Core\User\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserEntryRequest;
use App\Session;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        //  $this->middleware('right');
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            $nrcRepo = new NrcRepository();
            $userAry = array();
            $role_id = Auth::user()->role_id;
            switch ($role_id) {
                case 1:
                    $users = $this->userRepository->getAllUsers();
                    break;
                case 2:
                    $users = $this->userRepository->getUsersForAdmin();
                    break;
                case 3:
                    $users = $this->userRepository->getUsersForVerifier();
                    break;
                case 4:
                    $users = $this->userRepository->getUsersForInspector();
                    break;
                default:
                    $users = $this->userRepository->getUsersForContractor();
                    break;
            }

            foreach ($users as $user) {
                $nrc = $nrcRepo->getUserNrc($user->id);
                if (!is_null($nrc)) {
                    $user->nrc_division = $nrc->nrc_division;
                    $user->nrc_township1 = $nrc->nrc_township1;
                    $user->nrc_township2 = $nrc->nrc_township2;
                    $user->nrc_township3 = $nrc->nrc_township3;
                    $user->nrc_national = $nrc->nrc_national;
                    $user->nrc_number = $nrc->nrc_number;
                }

            }

            $roles = $this->userRepository->getRoles();
            $cur_time = Carbon::now();
            $nrcs = $nrcRepo->getObjs();

            return view('core.user.index')->with('users', $users)
                ->with('roles', $roles)
                ->with('cur_time', $cur_time)
                ->with('nrcs', $nrcs);
            //}
        }
        return redirect('/backend/login');
    }

    public function status_change($status, $id)
    {
        User::where('id', $id)->update(['status' => $status]);
        return redirect()->action('Core\UserController@index')->with('status', $status);
    }

    public function create()
    {
        if (Auth::check()) {
            $roles = $this->userRepository->getRoles();
            return view('core.user.user')->with('roles', $roles);
        }
        return redirect('/backend/login');
    }

    public function store(UserEntryRequest $request)
    {
        try {
            $validated = $request->validated();
            $user_name = trim(Input::get('user_name'));
            $display_name = trim(Input::get('display_name'));
            $email = trim(Input::get('email'));
            $password = trim(bcrypt(Input::get('password')));
            $roleId = Input::get('role_id');
            $address = trim(Input::get('address'));

            //get nrc
            $nrc_division = Input::get('nrc_division');
            $nrc_township1 = Input::get('nrc_township1');
            $nrc_township2 = Input::get('nrc_township2');
            $nrc_township3 = Input::get('nrc_township3');
            $nrc_national = Input::get('nrc_national');
            $nrc_number = Input::get('nrc_number');

            DB::beginTransaction();

            $userObj = new User();
            $userObj->user_name = $user_name;
            $userObj->display_name = $display_name;
            $userObj->email = $email;
            $userObj->password = $password;
            $userObj->role_id = $roleId;
            $userObj->address = $address;

            $result = $this->userRepository->create($userObj);

            if ($result['laravelStatusCode'] == ReturnMessage::OK) {

                // For adding user nirc case
                // $nrcObj                 = new Nrc();
                // $nrcObj->user_id        = $userObj->id;
                // $nrcObj->nrc_division   = $nrc_division;
                // $nrcObj->nrc_national   = $nrc_national;
                // $nrcObj->nrc_township1  = $nrc_township1;
                // $nrcObj->nrc_township2  = $nrc_township2;
                // $nrcObj->nrc_township3  = $nrc_township3;
                // $nrcObj->nrc_number     = $nrc_number;

                // $nrcRepo                = new NrcRepository();
                // $nrcResult              = $nrcRepo->create($nrcObj);
                $nrcResult = $result;

                if ($nrcResult['laravelStatusCode'] == ReturnMessage::OK) {
                    DB::commit();
                    return redirect()->action('Core\UserController@index');
                } else {
                    DB::rollback();
                    return redirect()->action('Core\UserController@index')
                        ->with(FormatGenerator::message('Fail', 'User did not create ...'));
                }
            } else {
                DB::rollback();
                return redirect()->action('Core\UserController@index')
                    ->with(FormatGenerator::message('Fail', 'User did not create ...'));
            }
        } catch (\Exception $e) {
            return redirect()->action('Core\UserController@index')
                ->with(FormatGenerator::message('Fail', 'User did not create ...'));
        }
    }

    public function edit($id)
    {
        if (Auth::check()) {

            $user = $this->userRepository->getObjByID($id);
            if (isset($user)) {
                $nrcRepo = new NrcRepository();
                $nrc = $nrcRepo->getUserNrc($id);

                // $roles = DB::table('core_roles')->get();
                $roles = $this->userRepository->getRoles();
                return view('core.user.user')->with('user', $user)->with('roles', $roles)->with('nrc', $nrc);
            } else {
                return redirect()->action('Core\UserController@index')
                    ->with(FormatGenerator::message('Fail', 'Error in loading the user to edit !!!'));
            }
        }
        return redirect('/backend/login');
    }

    public function update(UserEditRequest $request)
    {
        try {
            $validated = $request->validated();
            $id = Input::get('id');
            $user_name = Input::get('user_name');
            $display_name = Input::get('display_name');
            $email = Input::get('email');
            $address = Input::get('address');
            $roleId = Input::get('role_id');

            //get nrc
            $nrc_division = Input::get('nrc_division');
            $nrc_national = Input::get('nrc_national');
            $nrc_township1 = Input::get('nrc_township1');
            $nrc_township2 = Input::get('nrc_township2');
            $nrc_township3 = Input::get('nrc_township3');
            $nrc_number = Input::get('nrc_number');

            // $nrcRepo = new NrcRepository();
            //     $nrcObj = $nrcRepo->getUserNrc($id);
            //     dd($nrcObj);

            DB::beginTransaction();

            $userObj = User::find($id);
            $userObj->user_name = $user_name;
            $userObj->display_name = $display_name;
            $userObj->email = $email;
            $userObj->role_id = $roleId;
            $userObj->address = $address;
            $password = Input::get('password');

            if (isset($password) && $password != "") {
                $pwd = trim(bcrypt(Input::get('password')));
                $userObj->password = $pwd;
            }
            $result = $this->userRepository->update($userObj);

            if ($result['laravelStatusCode'] == ReturnMessage::OK) {

                // For User NIRC Update Case
                // $nrcRepo = new NrcRepository();
                // $nrcObj = $nrcRepo->getUserNrc($id);
                // $nrcObj->user_id = $userObj->id;
                // $nrcObj->nrc_division = $nrc_division;
                // $nrcObj->nrc_national = $nrc_national;
                // $nrcObj->nrc_township1 = $nrc_township1;
                // $nrcObj->nrc_township2 = $nrc_township2;
                // $nrcObj->nrc_township3 = $nrc_township3;
                // $nrcObj->nrc_number = $nrc_number;
                // $nrcResult = $nrcRepo->update($nrcObj);
                $nrcResult = $result;

                if ($nrcResult['laravelStatusCode'] == ReturnMessage::OK) {
                    DB::commit();
                    return redirect()->action('Core\UserController@index');
                } else {
                    DB::rollback();
                    return redirect()->action('Core\UserController@index')
                        ->with(FormatGenerator::message('Fail', 'User did not update ...'));
                }
            } else {
                DB::rollback();
                return redirect()->action('Core\UserController@index')
                    ->with(FormatGenerator::message('Fail', 'User did not update ...'));
            }
        } catch (\Exception $e) {
            return redirect()->action('Core\UserController@index')
                ->with(FormatGenerator::message('Fail', 'User did not update ...'));
        }
    }

    public function profile($id)
    {
        if (Auth::check()) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];

            if ($id == $loginUserId) {
                $user = $this->userRepository->getObjByID($id);
                // $roles = DB::table('core_roles')->get();
                $roles = $this->userRepository->getRoles();
                return view('core.user.user')->with('user', $user)->with('roles', $roles)->with('profile', true);
            } else {
                return redirect('errors/504');
            }

        } else {
            return redirect('unauthorize');
        }
    }

    public function destroy()
    {
        $id = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach ($new_string as $id) {
            $this->userRepository->delete($id);
        }
        return redirect()->action('Core\UserController@index'); //to redirect listing page
    }

    public function disable()
    {
        if (Auth::check()) {

            $id = Input::get('id');
            $userObj = $this->userRepository->getObjByID($id);

            if (isset($userObj)) {
                $nrcRepo = new NrcRepository();
                $userObj->status = 0;
                $result = $this->userRepository->update($userObj);

                if ($result['laravelStatusCode'] == ReturnMessage::OK) {
                    return redirect()->action('Core\UserController@index')
                        ->with(FormatGenerator::message('Success', 'User deactivated ...'));
                } else {
                    return redirect()->action('Core\UserController@index')
                        ->with(FormatGenerator::message('Fail', 'User did not deactivate !!! '));
                }
            } else {
                return redirect()->action('Core\UserController@index')
                    ->with(FormatGenerator::message('Error', 'Invalid user to deactivate, please check user again !!!!! '));

            }
        }
        return redirect('/backend/login');
    }

    public function enable()
    {
        if (Auth::check()) {
            $id = Input::get('id');
            $userObj = $this->userRepository->getObjByID($id);

            if (isset($userObj)) {
                $nrcRepo = new NrcRepository();
                $userObj->status = 1;
                $result = $this->userRepository->update($userObj);

                if ($result['laravelStatusCode'] == ReturnMessage::OK) {
                    return redirect()->action('Core\UserController@index')
                        ->with(FormatGenerator::message('Success', 'User activated ...'));
                } else {
                    return redirect()->action('Core\UserController@index')
                        ->with(FormatGenerator::message('Fail', 'User did not activate !!! '));
                }
            } else {
                return redirect()->action('Core\UserController@index')
                    ->with(FormatGenerator::message('Error', 'Invalid user to activate, please check user again !!!!! '));

            }
        }
        return redirect('/backend/login');
    }

    public function multipleEnable()
    {
        $id = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach ($new_string as $id) {
            $this->userRepository->activate($id);
        }
        return redirect()->action('Core\UserController@index')
            ->with(FormatGenerator::message('Success', 'de-activated successfully   !!!'));
    }

    public function getAuthUser() //after login, update status field 0 to 1
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $cur = Carbon::now();
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $cur);
            $this->userRepository->changeDisableToEnable($id, $cur);
            $role = DB::table('core_users')->find($id);

            if ($role->role_id == 1) {
                return redirect('/backend_app');
            } else if ($role->role_id == 2) {
                return redirect('/backend_app');
            } else {
                return redirect('/backend_app');
            }
        }
        else{
            return redirect('/backend_app/login');
        }
    }

    public function check_email()
    {
        $temp_str = Input::get('email');
        $temp_arr = explode('-', $temp_str);
        $email = $temp_arr[0];
        $id = $temp_arr[1];
        $result = false;

        if ($id != "") {
            $checkEmail = $this->userRepository->getcheckEmailwithID($email, $id);
        } else {
            $checkEmail = $this->userRepository->getcheckEmail($email);

        }
        if (is_null($checkEmail)) {
            $result = true;
        }
        return \Response::json($result);
    }

    public function check_pwd($id, $pwd)
    {
        if (Auth::guard('User')->check()) {
            $validation = Auth::guard('User')->attempt([
                'id' => $id,
                'password' => $pwd,
            ]);
            return \Response::json($validation);
        }
        return redirect('backend/');

    }

    public function check_user()
    {
        $temp_str = Input::get('nrc_number');
        $result = Check::checkUser($temp_str);
        return \Response::json($result);
    }

    public function check_uname()
    {
        $temp_str = Input::get('user_name');
        $temp_arr = explode('/', $temp_str, 2);
        $name = $temp_arr[0];
        $id = $temp_arr[1];
        $result = false;

        if ($id != "") {
            $checkCode = $this->userRepository->check_uname_ID($name, $id);
        } else {
            $checkCode = $this->userRepository->check_uname($name);
        }
        if (is_null($checkCode)) {
            $result = true;
        }
        return \Response::json($result);
    }

    public function passwordEdit($id)
    {
        if (Auth::check()) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];

            if ($id == $loginUserId) {
                $user = $this->userRepository->getObjByID($id);
                return view('core.user.user_password')->with('user', $user)->with('profile', true);
            } else {
                return redirect('errors/504');
            }

        } else {
            return redirect('unauthorize');
        }
    }

    public function passwordUpdate(Request $request,$id)
    {
        if (Auth::check()) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];

            if ($id == $loginUserId) {
                $userObj        = User::find($loginUserId);
                $request->validate([
                    'password' => 'required|confirmed|min:8',
                    'current_password' => ['required', function ($attribute, $value, $fail) use ($userObj) {
                        if (!\Hash::check($value, $userObj->password)) {
                            return $fail(__('The current password is incorrect.'));
                        }
                    }],
                ]);

                $password = Input::get('password');
                $pwd = trim(bcrypt(Input::get('password')));
                $userObj->password = $pwd;
                $result = $this->userRepository->update($userObj);
               
                if ($result['laravelStatusCode'] == ReturnMessage::OK) {                    
                    return redirect()->action('Core\UserController@passwordEdit',[$loginUserId])
                            ->with(FormatGenerator::message('Success', 'password updated successfully !'));
                } else {
                    return redirect()->action('Core\UserController@passwordEdit',[$loginUserId])
                            ->with(FormatGenerator::message(' Fail',' Error in password updating !'));
                }

            } else {
                return redirect('errors/504');
            }

        } else {
            return redirect('unauthorize');
        }
    }
}
