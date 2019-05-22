<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public $timestamps=false;
    public function user(){
      return $this->belongsTo(User::class);
    }
}
