<?php

namespace App\Traits\Auth;

use App\Models\Invite;
use App\Traits\GeneratesToken;
use Illuminate\Support\Str;

trait Invites
{
    use GeneratesToken;

    public function invite($client_id, $user_id, $email)
    {
        $data = ['client_id' => $client_id, 'user_id' => $user_id, 'email' => $email];
        $invite = $this->createInvite($data);
        $invite->notify(new Invitation());
    }

    /**
     * Create a new email token instance for email confirmation.
     *
     * @param array $data
     *
     * @return EmailToken
     */
    protected function createInvite(array $data)
    {
        return Invite::create([
            'client_id' => $data['client_id'],
            'user_id' => $data['user_id'],
            'email'   => $data['email'],
            'token'   => $this->generateToken(),
        ]);
    }
}
