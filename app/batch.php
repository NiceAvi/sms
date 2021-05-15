<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class batch extends Model
{
    //

    protected $fillable = [
        'name',
        'subject_id',
        'teacher_id',
        'batch_date',
        'time'
    ];

}
