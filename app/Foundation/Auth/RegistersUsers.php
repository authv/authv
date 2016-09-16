<?php

namespace App\Foundation\Auth;

use Illuminate\Foundation\Auth\RegistersUsers as Registers;
use Illuminate\Http\Request;
use App\OAuth;
use App\User;
use Validator;

trait RegistersUsers
{
  use Registers;

  /**
   * Show the application join form.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function showJoinForm(Request $request)
  {
    if($request->session()->has('oauth_user_id')) {
      $id = $request->session()->get('oauth_user_id');
      $user = OAuth\User::where('id', $id)->first();
      if($user->email) {
        $readonlyEmail = "readonly";
      }
      return view('auth.join', ['name' => $user->name, 'nickname' => $user->nickname, 'email' => $user->email, 'readonly_email' => $readonlyEmail]);
    }
    return redirect('/register');
  }

  /**
   * Handle a registration request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function join(Request $request)
  {
    if(!$request->session()->has('oauth_user_id')) {
      return redirect('/register');
    }
    $this->joinValidator($request->all())->validate();
    $this->guard()->login($this->joinCreate($request->all()));
    return redirect($this->redirectPath());
  }

  /**
  * Get a validator for an incoming registration request.
  *
  * @param  array  $data
  * @return \Illuminate\Contracts\Validation\Validator
  */
  protected function joinValidator(array $data)
  {
    return Validator::make($data, [
      'name' => 'required|max:255',
      'username' => 'required|min:6|max:255|unique:users',
      'email' => 'required|email|max:255|unique:users',
    ]);
  }
  /**
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return User
  */
  protected function joinCreate(array $data)
  {
    return User::create([
      'name' => $data['name'],
      'username' => $data['username'],
      'email' => $data['email'],
    ]);
  }

}
