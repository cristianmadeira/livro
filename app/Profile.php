<?php

namespace Laravel;
use Illuminate\Database\Eloquent\Model;
class Profile extends Model
{

    public $table="profiles";
    protected $guarded=array("_token");
    //
    public function user(){
      return $this->belongsTo(User::class);
    }
}
