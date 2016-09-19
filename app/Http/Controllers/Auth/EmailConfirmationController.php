<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\EmailToken;
use Illuminate\Http\Request;

class EmailConfirmationController extends Controller
{
    /**
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\Response
   */
  public function confirm(Request $request)
  {
      $token = $request->input('token');
      $emailToken = EmailToken::where('token', $token)->first();
      if ($emailToken == null) {
          abort(401, 'Invalid token');
      }
      $emailToken->confirm();

      return redirect('/');
  }

  /**
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\Response
   */
  public function showConfirmationForm(Request $request, $token)
  {
      $emailToken = EmailToken::where('token', $token)->first();
      if ($emailToken == null) {
          abort(401, 'Invalid token');
      }
      if ($emailToken->confirmed) {
          return view('message')->with('text', 'This email address is already confirmed. You can login now using your credentials.');
      }
      if ($emailToken->expired) {
          return view('message')->with('text', 'Sorry! Your email confirmation link is now expired.');
      }

      return view('auth.emails.confirmation')->with('token', $token);
  }
}
