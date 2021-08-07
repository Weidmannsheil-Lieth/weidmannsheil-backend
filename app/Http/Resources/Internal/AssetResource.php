<?php

namespace App\Http\Resources\Internal;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
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
            'name'      => $this->name,
            'path'      => $this->path,
            'mime'      => $this->mime,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
