<?php

namespace App\Http\Resources\External;

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
            'title'           => $this->title,
            'content'         => $this->content,
            'renderedContent' => $this->rendered_content,
            'imageUrl'        => $this->image_url,
        ];
    }
}
