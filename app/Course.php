<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    // relation with course table
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    // relation with instructor table
    public function instructors()
    {
        return $this->belongsToMany('App\Instructor');
    }

    // relation with module table
    public function modules()
    {
        return $this->hasMany('App\Module');
    }

    // relation with review table
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
