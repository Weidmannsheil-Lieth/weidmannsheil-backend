<?php

namespace App\Http\Resources\External;

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
            'year'          => $this->year,
            'name'          => $this->name,
            'galleryImages' => GalleryImageResource::collection($this->whenLoaded('galleryImages'))
        ];
    }
}
