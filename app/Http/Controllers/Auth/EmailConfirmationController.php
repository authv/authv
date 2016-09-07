<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\EmailToken;

class EmailConfirmationController extends Controller
{

  /**
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function confirm(Request $request, $token) {
    $token = EmailToken::where('token', $token) -> first();
    $token->confirm();
    return redirect('/');
  }

}
