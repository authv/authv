<?php

namespace App\Traits\Auth;

use Exception;

trait EmailToken
{
    public function confirm()
    {
        if ($this->confirmed) {
            throw new Exception('This email address is already confirmed. You can login now using your credentials.');
        }
        if ($this->expired) {
            throw new Exception('Sorry! Your email confirmation link is now expired.');
        }
        $this->confirmed = true;
        $this->save();
    }
}
