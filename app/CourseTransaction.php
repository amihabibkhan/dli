<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseTransaction extends Model
{
    protected $guarded = [];

    // relation with course table
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
