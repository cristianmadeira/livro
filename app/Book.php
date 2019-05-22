<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public $table="books";
    protected $guarded=array("_token");
    public $timestamps = false;
    public function users(){
      return $this->belongsToMany(User::class,"users_books");
    }
}
