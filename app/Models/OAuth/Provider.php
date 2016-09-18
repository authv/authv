<?php

namespace App\Models\OAuth;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oauth_providers';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get all of the users for the provider.
     */
    public function users()
    {
      return $this->hasMany('App\Models\OAuth\User');
    }
}
