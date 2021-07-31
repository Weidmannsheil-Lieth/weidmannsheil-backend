<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $fillable = [
        'route',
        'count',
        'recording_at'
    ];

    protected $casts = [
        'count'        => 'int',
        'recording_at' => 'date'
    ];
}
