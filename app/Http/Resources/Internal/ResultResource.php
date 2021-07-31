<?php

namespace App\Http\Resources\Internal;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
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
            'category'      => $this->category,
            'name'          => $this->name,
            'contentType'   => $this->content_type,
            'contentAction' => $this->content_action,
            'createdAt'     => $this->created_at,
            'updatedAt'     => $this->updated_at
        ];
    }
}
