<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailReceiverGroup extends Model
{
    protected $fillable = [
        'name',
        'mail_receivers'
    ];
}
