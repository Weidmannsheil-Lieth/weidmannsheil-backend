<?php

namespace App\Http\Resources\Internal;

use Illuminate\Http\Resources\Json\JsonResource;

class GalleryAlbumResource extends JsonResource
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
            'id'            => $this->id,
            'year'          => $this->year,
            'name'          => $this->name,
            'createdAt'     => $this->createdAt,
            'updatedAt'     => $this->updatedAt,
            'galleryImages' => GalleryImageResource::collection($this->whenLoaded('galleryImages'))
        ];
    }
}
