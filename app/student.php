<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class student extends Model
{
    //

    protected $fillable = [
        'roll_no',
        'name',
        'dob',
        'address',
        'mobile'
    ];
}
