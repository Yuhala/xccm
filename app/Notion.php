<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notion extends Model
{
    protected $fillable = [
        'title', 'section_id','content'
    ];

}
