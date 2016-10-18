<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\User;
use Validator;

class CompletionController extends Controller
{

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
        if($data['email_confirmed'])
        $this->sendEmailConfirmation($user);

        return $user;
    }
}
