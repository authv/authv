<?php

namespace App\Traits\Auth;

use App\Models\OAuth;
use App\User;
use Illuminate\Http\Request;
use Validator;

trait Completes
{

  /**
   * Show the application join form.
   *
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\Response
   */
  public function showForm(Request $request)
  {
      if ($request->session()->has('oauth_user_id')) {
          $id = $request->session()->get('oauth_user_id');
          $user = OAuth\User::where('id', $id)->first();
          if ($user->email) {
              $readonlyEmail = 'readonly';
          }

          return view('auth.join', ['name' => $user->name, 'nickname' => $user->nickname, 'email' => $user->email, 'readonly_email' => $readonlyEmail]);
      }

      return redirect('/register');
  }

  /**
   * Handle a registration request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\Response
   */
  public function join(Request $request)
  {
      if (!$request->session()->has('oauth_user_id')) {
          return redirect('/register');
      }
      $oid = $request->session()->get('oauth_user_id');
      $ouser = OAuth\User::where('id', $oid)->first();
      $this->joinValidator($request->all())->validate();
      $user = $this->joinCreate($request->all());
      $ouser->user_id = $user->id;
      $this->guard()->login($user);

      return redirect($this->redirectPath());
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   *
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
      return Validator::make($data, [
      'name'     => 'required|max:255',
      'username' => 'required|min:6|max:255|unique:users',
      'email'    => 'required|email|max:255|unique:users',
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   *
   * @return User
   */
  protected function create(array $data)
  {
      return User::create([
      'name'     => $data['name'],
      'username' => $data['username'],
      'email'    => $data['email'],
    ]);
  }
}
