<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invite;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
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
    $invite->redeem();

    return redirect('/');
  }

}
