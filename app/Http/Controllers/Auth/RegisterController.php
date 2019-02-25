<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\UserType;
use App\Sector;
use App\Department;
use App\DepartmentHead;
use App\SectorHead;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'position' => 'required',
            'username' => 'required|unique:users,username',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'user_type_id' => 'required|exists:user_types,id',
            'sector_id' => 'required_if:user_type_id,3|exists:sectors,id',
            'department_id' => 'required_if:user_type_id,1|exists:departments,id',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'user_type_id' => $data['user_type_id'],
            'position' => $data['position'],
            // 'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if($user->type->name == "Department Head"){
            $deptHead = DepartmentHead::create(['department_id' => $data['department_id']]);
            $deptHead->user()->save($user);
        }
        else if($user->type->name == "Sector Head"){
            $sectorHead = SectorHead::create(['sector_id' => $data['sector_id']]);
            $sectorHead->user()->save($user);
        }
        else if($user->type->name == "BAC Secretariat"){
            $deptHead = DepartmentHead::create(['department_id' => 1]);
            $deptHead->user()->save($user);
        }

        return $user;
    }

    public function showRegistrationForm()
    {
        $sectors = Sector::all();

        $availSectors = Sector::doesntHave('head')->get();

        $departments = Department::doesntHave('head')->get();

        $userTypes = UserType::all()->whereNotIn('id', 4);

        if(User::where('user_type_id', 2)->first()){ //if there is already a Budget Officer in users table
            $userTypes = $userTypes->whereNotIn('id', 2);
        }
        if(User::where('user_type_id', 5)->first()){ //if there is already BAC Sec in users table
            $userTypes = $userTypes->whereNotIn('id', 5);
        }

        return view('auth.register', compact('userTypes', 'departments', 'sectors', 'availSectors'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect()->route('users.index');
    }
}
