<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $fillable = [
        'action_id',
        'username',
        'ip_address',
        'ip_address_details'
    ];

    public const ACTION_LOGIN_SUCCESS = 1;
    public const ACTION_LOGIN_FAILED = 2;
    public const ACTION_LOGOUT = 3;
}
