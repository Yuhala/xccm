<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'author_id', 'language','introduction',"conclusion",
        'domain', 'course_structure'
    ];
}