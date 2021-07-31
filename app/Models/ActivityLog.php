<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'activity_id',
        'user_id',
        'model_type',
        'model_id',
        'content'
    ];

    public const ACTIVITY_CREATE = 1;
    public const ACTIVITY_UPDATE = 2;
    public const ACTIVITY_DELETE = 3;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
