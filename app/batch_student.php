<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class batch_student extends Model
{
    //
    protected $table = 'table_batch_student';

    protected $fillable =[
        'batch_id',
        'student_id'
    ];
}
