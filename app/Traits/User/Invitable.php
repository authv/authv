<?php

namespace App\Traits\User;

use App\Models\Invite;
use App\Traits\Util\GeneratesToken;
use Illuminate\Support\Str;

trait Invitable
{
    use GeneratesToken;

    public function invite($client_id, $email)
    {
        $data = ['client_id' => $client_id, 'user_id' => $this->id, 'email' => $email];
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
