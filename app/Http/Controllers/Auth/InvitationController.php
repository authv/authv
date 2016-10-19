<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use App\User;
use Auth;
use Exception;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
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
   * Create a new user instance after a valid registration.
   *
   * @param array $data
   *
   * @return User
   */
  protected function create($email)
  {
      $user = User::create([
          'email'    => $email,
      ]);

      return $user;
  }

  /**
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\Response
   */
  public function redeem(Request $request, $token)
  {
      $invite = Invite::where('token', $token)->first();
      $request->session()->put('return_url', $invite->client->url);
      if ($invite == null) {
          abort(401, 'Invalid token');
      }
      if ($invite->redeemed_id) {
          throw new Exception('This invitation already accepted.');
      }
      $user = User::where('email', $invite->email)->first();
      if ($user) {
          throw new Exception('This email address already associated with another account.');
      }
      $user = $this->create($invite->email);
      $invite->redeem($user);
      Auth::login($user);

      return redirect()->route('complete-profile');
  }
}
