<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GalleryAlbum extends Model
{
    protected $fillable = [
        'year',
        'name'
    ];

    /**
     * @return HasMany
     */
    public function galleryImages(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }
}
