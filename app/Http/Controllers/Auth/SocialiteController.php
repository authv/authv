<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App;
use App\Models\OAuth;
use Auth;

class SocialiteController extends Controller
{

  /**
   * Redirect the user to the Google authentication page.
   *
   * @return Response
   */
  public function redirectToGoogle()
  {
    return $this->redirectTo('google');
  }

  /**
   * Redirect the user to the Provider's authentication page.
   *
   * @return Response
   */
  public function redirectTo($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  /**
   * Obtain the user information from Provider.
   *
   * @return Response
   */
  public function handleCallback(Request $request, $providerName)
  {
    $provider = OAuth\Provider::where('name', $providerName)->first();
    $puser = Socialite::driver($providerName)->user();
    $ouser = $provider->users()->where('id', $puser->getId())->first();
    if($ouser == null) {
      $ouser = $this->create($provider->id, $puser);
    }
    if($ouser->user_id) {
      Auth::loginUsingId($ouser->user_id, true);
      return $this->redirectAfterLogin();
    } else {
      if($puser->getEmail()) {
        $user = App\User::where('email', $puser->getEmail())->first();
        if($user) {
          $ouser->user_id = $user->id;
          $ouser->save();
          Auth::login($user, true);
          return $this->redirectAfterLogin();
        }
      }
      return redirect()->route('join');
    }
  }

  public function redirectAfterLogin() {
    return redirect('/');
  }

  protected function create($providerId, $puser) {
    $ouser = new OAuth\User;
    $ouser->provider_id = $providerId;

    $ouser->id = $puser->getId();
    $ouser->name = $puser->getName();
    $ouser->nickname = $puser->getNickname();
    $ouser->email = $puser->getEmail();
    $ouser->avatar = $puser->getAvatar();

    $ouser->token = $puser->token;
    if(isset($puser->tokenSecret)) {
      $ouser->token_secret = $puser->tokenSecret;
    } else {
      $ouser->refresh_token = $puser->refreshToken;
      $ouser->expires_in = $puser->expiresIn;
    }

    $ouser->save();
    return $ouser;
  }

  /**
   * Obtain the user information from Google.
   *
   * @return Response
   */
  public function handleGoogleCallback(Request $request)
  {
    return $this->handleCallback($request, 'google');
  }

}
