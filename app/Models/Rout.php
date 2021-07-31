<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rout extends Model
{
    protected $fillable = [
        'year',
        'king',
        'first_knight',
        'second_knight',
        'youth_king',
        'citizen_king',
        'citizen_youth_king'
    ];
}
