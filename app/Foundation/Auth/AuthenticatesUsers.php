<?php

namespace App\Foundation\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers as Authenticates;
use Illuminate\Http\Request;

trait AuthenticatesUsers
{

  use Authenticates {
    username as legacyUsername;
    credentials as legacyCredentials;
	}

	/**
   * Get the needed authorization credentials from the request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  protected function credentials(Request $request)
  {
		echo "aa";
		$loginInput = $request->input($this->username());
		$loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
		$request->merge([$loginField => $loginInput]);
    return $request->only($loginField, 'password');
  }

	/**
   * Get the login username to be used by the controller.
   *
   * @return string
   */
  public function username()
  {
    return 'login';
  }

}
