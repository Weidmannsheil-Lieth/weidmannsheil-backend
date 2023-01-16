<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notice extends Model
{
    protected $fillable = [
        'priority',
        'title',
        'content'
    ];
}
