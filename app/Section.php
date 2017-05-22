<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable=[
        "title", 'chapter_id', "introduction", "conclusion"
    ];
}
