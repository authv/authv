<?php

namespace App\Traits\Util;

use Illuminate\Support\Str;

trait GeneratesToken
{
    /**
   * Create a new token for the user.
   *
   * @return string
   */
  protected function generateToken($length = 32)
  {
      return hash_hmac('sha256', Str::random($length), $this->getHashKey());
  }

    protected function getHashKey()
    {
        $key = config('app.key');

        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        return $key;
    }
}
