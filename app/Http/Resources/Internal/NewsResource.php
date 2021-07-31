<?php

namespace App\Http\Resources\Internal;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'id'        => $this->id,
            'priority'  => $this->priority,
            'title'     => $this->title,
            'content'   => $this->content,
            'imageUrl'  => $this->image_url,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
