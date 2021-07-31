<?php

namespace App\Http\Resources\Internal;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'galleryAlbumId' => $this->gallery_album_id,
            'path'           => $this->path,
            'createdAt'      => $this->created_at,
            'updatedAt'      => $this->updated_at
        ];
    }
}
