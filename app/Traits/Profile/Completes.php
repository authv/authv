<?php

namespace App\Traits\Auth;

use App\Models\OAuth;
use App\User;
use Auth;
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
      if ($request->session()->has('oauth_user_id') && Auth::guest()) {
          $id = $request->session()->get('oauth_user_id');
          $user = OAuth\User::where('id', $id)->whereNull('email')->first();
          if($user) {
            return view('profile.complete', ['name' => $user->name, 'username' => $user->nickname, 'askEmail' => true]);
          }
      } elseif (Auth::check()) {
        $user = Auth::user();
        return view('profile.complete', ['name' => $user->name, 'username' => $user->username, 'askEmail' => false]);
      }

      return redirect('/register');
  }

  /**
   * Handle a profile completion request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\Response
   */
  public function complete(Request $request)
  {
      if ($request->session()->has('oauth_user_id') && Auth::guest()) {
        $oid = $request->session()->get('oauth_user_id');
        $ouser = OAuth\User::where('id', $oid)->whereNull('email')->first();
        if ($ouser) {
          $this->validator($request->all(), true)->validate();
          $user = $this->create($request->all());
          $ouser->user_id = $user->id;
          $ouser->save();
          Auth::login($user, true);
        }
      } elseif (Auth::check()) {
        $this->validator($request->all(), false)->validate();
        $user = Auth::user();
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->save();
      }
      return redirect('/');
  }
}
