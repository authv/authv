<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use Illuminate\Http\Request;
use Exception;

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
  protected function create(array $data)
  {
      $user = User::create([
          'email'    => $data['email'],
      ]);
      return $user;
  }

  /**
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\Response
   */
  public function redeem(Request $request)
  {
    $token = $request->input('token');
    $invite = Invite::where('token', $token)->first();
    if ($invite == null) {
        abort(401, 'Invalid token');
    }
    if ($invite->redeemed_id) {
        throw new Exception('This invitation already accepted.');
    }
    $user = $this->create($invite->email);
    $invite->redeem($user);
    Auth::login($user);
    return redirect()->route('join');
  }

}
