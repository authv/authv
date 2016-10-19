<?php

namespace App\Facades;

use Crypt;
use Exception;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Route;
use Validator;

class Authv extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'authv';
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

        Route::get('/users/accept-invitation/{token}', 'Auth\InvitationController@redeem')->name('redeem');

        self::socialiteRoutes();
    }

    protected static function socialiteRoutes()
    {
        Route::get('/profile/complete', 'Profile\CompletionController@showForm')->name('complete-profile');
        Route::post('/profile/complete', 'Profile\CompletionController@complete');

        Route::get('/oauth2/{provider}', 'Auth\SocialiteController@redirectTo');
        Route::get('/oauth2/{provider}/callback', 'Auth\SocialiteController@handleCallback');

        Route::get('/sso/discourse', 'SSO\DiscourseController@get')->name('discourse-sso');
    }

    public static function immigrationFields()
    {
        $html = '<div id="immigration" class="hidden">'."\r\n".
              '<input name="password_confirmation" type="text" value="" id="password-confirm" />'."\r\n".
              '<input name="captcha" type="text" id="captcha" value="'.Crypt::encrypt(time()).'"/>'."\r\n".
              '</div>';

        return $html;
    }

    public static function immigrationValidator()
    {
        Validator::extend('immigration', function ($attribute, $value, $parameters, $validator) {
            switch ($parameters[0]) {
          case 'empty':
            return empty($value);
            break;

          case 'interval':
            try {
                $time = Crypt::decrypt($value);

                return  is_numeric($time) && time() > ($time + $parameters[1]);
            } catch (Exception $exception) {
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
