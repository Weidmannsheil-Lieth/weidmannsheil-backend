<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'priority',
        'title',
        'content',
        'image_url'
    ];

    protected $appends = [
        'rendered_content'
    ];

    /**
     * @return string
     */
    public function getRenderedContentAttribute(): string
    {
        return Str::markdown($this->content);
    }
}
