<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;
use Crypt;
use Exception;
use Validator;

class MO extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mo';
    }

    /**
     * Register the typical authentication routes for an application.
     *
     * @return void
     */
    public static function routes()
    {
      Route::get('/users/activate-account/{token}', 'Auth\EmailConfirmationController@showConfirmationForm')->name('confirm-email');
      Route::post('/users/activate-account', 'Auth\EmailConfirmationController@confirm');
      self::socialiteRoutes();
    }

    protected static function socialiteRoutes() {
      Route::get('/join', 'Auth\RegisterController@showJoinForm')->name('join');
      Route::post('/join', 'Auth\RegisterController@join');
      // OAuth2 Sign in
      Route::get('/oauth2/google', 'Auth\SocialiteController@redirectToGoogle')->name('oauth2-google');
      Route::get('/oauth2/facebook', 'Auth\SocialiteController@redirectToFacebook')->name('oauth2-facebook');
      // OAuth2 Sign in Callbacks
      Route::get('/oauth2/google/callback', 'Auth\SocialiteController@handleGoogleCallback');
      Route::get('/oauth2/facebook/callback', 'Auth\SocialiteController@handleFacebookCallback');
    }

    public static function immigrationFields()
    {
      $html = '<div id="immigration" class="hidden">' . "\r\n" .
              '<input name="password_confirmation" type="text" value="" id="password-confirm" />' . "\r\n" .
              '<input name="captcha" type="text" id="captcha" value="' . Crypt::encrypt(time()) . '"/>' . "\r\n" .
              '</div>';
      return $html;
    }

    public static function immigrationValidator() {
      Validator::extend('immigration', function($attribute, $value, $parameters, $validator) {
        switch ($parameters[0]) {
          case 'empty':
            return empty($value);
            break;

          case 'interval':
            try {
              $time = Crypt::decrypt($value);
              return ( is_numeric($time) && time() > ($time + $parameters[1]) );
            }
            catch (Exception $exception) {
              return false;
            }
            break;

          default:
            return false;
            break;
        }
      });
    }

}
