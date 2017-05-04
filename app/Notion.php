<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notion extends Model
{
    protected $fillable = [
        'title', 'author', 'domain','content','paragraph_id'
    ];

}
