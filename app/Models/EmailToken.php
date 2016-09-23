<?php

namespace App\Models;

use App\Traits\Auth\EmailToken as Confirmable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmailToken extends Model
{
    use Notifiable, Confirmable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'email', 'token',
  ];

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
