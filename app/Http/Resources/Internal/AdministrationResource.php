<?php

namespace App\Http\Resources\Internal;

use Illuminate\Http\Resources\Json\JsonResource;

class AdministrationResource extends JsonResource
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
            'name'      => $this->name,
            'members'   => $this->members,
            'email'     => $this->email,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}
