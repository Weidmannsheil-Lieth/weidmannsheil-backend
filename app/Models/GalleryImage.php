<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryImage extends Model
{
    protected $fillable = [
        'id',
        'gallery_album_id',
        'path'
    ];

    /**
     * @return BelongsTo
     */
    public function galleryAlbum(): BelongsTo
    {
        return $this->belongsTo(GalleryAlbum::class);
    }
}
