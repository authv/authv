<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oauth_users';

    public $incrementing = false;

    /**
     * Get the provider of the oauth user.
     */
    public function provider()
    {
        return $this->belongsTo('App\Models\OAuth\Provider');
    }
}
