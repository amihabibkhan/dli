<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    // relation with user table
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
