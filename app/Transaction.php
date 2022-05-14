<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    // relation with course_transaction table
    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_transactions', 'transaction_id');
    }

    // relation with user table
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
