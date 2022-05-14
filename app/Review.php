<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];

    // relation with user table
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
