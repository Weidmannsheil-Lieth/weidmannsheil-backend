<?php

namespace App\Http\Resources\Internal;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'           => $this->id,
            'abbreviation' => $this->abbreviation,
            'username'     => $this->username,
            'name'         => $this->name,
            'email'        => $this->email,
            'createdAt'    => $this->createdAt,
            'updatedAt'    => $this->updatedAt
        ];
    }
}
