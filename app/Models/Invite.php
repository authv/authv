<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    use Notifiable;

    protected $fillable = [
      'client_id', 'user_id', 'email', 'token',
  ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function redeem(User $user)
    {
        $this->redeemed_id = $user->id;
        $this->redeemed_at = Carbon::now();
        $this->save();
    }
}
