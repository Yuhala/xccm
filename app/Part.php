<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'title', 'course_id', 'introduction','conclusion'
    ];
}
