<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon;
use Str;

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
     * @return \Illuminate\Http\Response
     */
    protected function redirectTo() {
        return redirect()->route('dashboard');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $currentYear = date('Y');
        $minYear = $currentYear - 100;
        $yearsBetween = sprintf('between:%d,%d', $minYear, $currentYear);

        if (array_key_exists('dob_month', $data) && array_key_exists('dob_day', $data)) {
            if (in_array($data['dob_month'], array('9','4','6','11'))) {
                $daysBetween = 'between:1,30';
            } elseif ($data['dob_month'] == '2') {
                $year = intval($data['dob_year']);
                if ($year && !($year % 4) && ($year % 100)) {
                    $daysBetween = 'between:1,29';
                } else {
                    $daysBetween = 'between:1,28';
                }
            } else {
                $daysBetween = 'between:1,31';
            }
        } else { $daysBetween = 'between:1,31'; }

        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],

            'city' => ['required', 'string', 'max:255'],
            'region' => ['required', 'string'],
            'phone' => ['required', 'string'],

            'dob_day' => ['required_if:role,sitter', 'numeric', $daysBetween],
            'dob_month' => ['required_if:role,sitter', 'numeric', 'between:1,12'],
            'dob_year' => ['required_if:role,sitter', 'numeric', $yearsBetween],

            'dob' => ['date'],
            'role' => ['required', 'string', 'regex:/^(sitter|parent)$/'],
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
        if (!array_key_exists('dob', $data)) {
            if (array_key_exists('dob_month', $data)
                && array_key_exists('dob_day', $data)
                && array_key_exists('dob_year', $data)) {
                    $dob = Carbon\Carbon::createFromDate(intval($data['dob_year']),intval($data['dob_month']),intval($data['dob_day']))->toDateString();
            } else {
                $dob = null;
            }
        } else {
            $dob = $data['dob'];
        }

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),

            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],

            'city' => $data['city'],
            'region' => $data['region'],
            'phone' => $data['phone'],

            'dob' => $dob
        ]);

        $role = 'unknown';

        if (is_string($data['role']) && in_array($data['role'], array('sitter', 'parent'))) {
            if (password_verify(sprintf('%s%s', $data['role'], $data['_token']), $data['validator'])) {
                $role = $data['role'];
            }
        }

        $user->roles()
            ->attach(Role::where('name', $role)->first());

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Show the role-specific registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRoleRegistrationForm($role = null)
    {
        if (is_string($role) && preg_match('/'.env('REGISTER_ALLOWED_ROLES', 'sitter|parent').'/', $role)) {
            return view('auth.registerRole', ['role' => $role]);
        }
        return redirect('register');
    }
}
