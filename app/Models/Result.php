<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'category',
        'name',
        'content_type',
        'content_action'
    ];

    protected $casts = [
        'content_type' => 'int'
    ];

    public const TYPE_DOWNLOAD = 1;
    public const TYPE_REDIRECT = 2;
}
