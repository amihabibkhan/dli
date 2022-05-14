<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $guarded = [];

    // relation with video table
    public function videos()
    {
        return $this->hasMany('App\Video');
    }
}
