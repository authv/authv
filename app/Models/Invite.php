<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use App\User;

class Invite extends Model
{
  use Notifiable;

  public function user()
  {
      return $this->hasOne('App\User');
  }

  public function client()
  {
      return $this->hasOne('App\Models\Client');
  }

  public function redeem(User $user)
  {
    $this->redeemed_id = $user->id;
    $this->redeemed_at = Carbon::now();
    $this->save();
  }

}
