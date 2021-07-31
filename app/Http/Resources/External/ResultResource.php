<?php

namespace App\Http\Resources\External;

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
            'category'      => $this->category,
            'name'          => $this->name,
            'contentType'   => $this->content_type,
            'contentAction' => $this->content_action
        ];
    }
}
