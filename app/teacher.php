<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class teacher extends Model
{
    //

    protected $fillable = [
        'join_date',
        'name',
        'address',
        'mobile',
        'dob'
    ];

}
