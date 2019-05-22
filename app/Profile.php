<?php

namespace Laravel;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
class Profile extends Authenticatable
{
    use Notifiable;
    public $guard="profile";
    public $table="profiles";
    //
    public function user(){
      return $this->belongsTo(User::class);
    }
}
