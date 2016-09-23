<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\Auth\RegistersUsers;
use App\Traits\Auth\SendsEmailConfirmations;
use App\User;
use Validator;

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

    use RegistersUsers, SendsEmailConfirmations;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                  => 'required|max:255',
            'username'              => 'required|min:6|max:255|alpha_dash|unique:users',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|min:6',
            'password_confirmation' => 'immigration:empty',
            'captcha'               => 'required|immigration:interval,4',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $this->sendEmailConfirmation($user);

        return $user;
    }
}
