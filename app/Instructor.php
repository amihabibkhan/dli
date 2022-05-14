<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $guarded = [];

    // relation with instructor table
    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }
}
