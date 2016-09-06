<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailToken extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'email_tokens';

  /**
   * Get the user record associated with the email token.
   */
  public function user()
  {
    return $this->hasOne('App\User');
  }
}
