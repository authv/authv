<?php

namespace App\Traits\Auth;

use App\Models\EmailToken;
use App\Notifications\EmailConfirmation;
use App\Traits\Util\GeneratesToken;
use App\User;
use Illuminate\Support\Str;

trait SendsEmailConfirmations
{
    use GeneratesToken;

    protected function sendEmailConfirmation(User $user)
    {
        $data = ['user_id' => $user->id, 'email' => $user->email];
        $emailToken = $this->createEmailToken($data);
        $emailToken->notify(new EmailConfirmation($emailToken->token));
    }

    /**
     * Create a new email token instance for email confirmation.
     *
     * @param array $data
     *
     * @return EmailToken
     */
    protected function createEmailToken(array $data)
    {
        return EmailToken::create([
            'user_id' => $data['user_id'],
            'email'   => $data['email'],
            'token'   => $this->generateToken(),
        ]);
    }
}
