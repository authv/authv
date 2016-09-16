<?php

namespace App\Foundation\Auth;

use Illuminate\Support\Str;

use App\User;
use App\Notifications\EmailConfirmation;
use App\Models\EmailToken;

trait SendsEmailConfirmations
{

    protected function sendEmailConfirmation(User $user) {
      $data = array('user_id' => $user->id, 'email' => $user->email);
      $emailToken = $this->createEmailToken($data);
      $emailToken->notify(new EmailConfirmation($emailToken->token));
    }
    
    /**
     * Create a new email token instance for email confirmation.
     *
     * @param  array  $data
     * @return EmailToken
     */
    protected function createEmailToken(array $data)
    {
        return EmailToken::create([
            'user_id' => $data['user_id'],
            'email' => $data['email'],
            'token' => $this->createNewToken(),
        ]);
    }

  /**
    * Create a new token for the user.
    *
    * @return string
  */
  protected function createNewToken()
  {
    return hash_hmac('sha256', Str::random(40), $this->getHashKey());
  }

  protected function getHashKey() {
    $key = config('app.key');

    if (Str::startsWith($key, 'base64:')) {
      $key = base64_decode(substr($key, 7));
    }

    return $key;
  }

}
