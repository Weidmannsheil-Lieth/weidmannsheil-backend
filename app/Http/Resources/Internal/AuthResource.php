<?php

namespace App\Http\Resources\Internal;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'apiToken'     => $this->api_token,
            'createdAt'    => $this->created_at,
            'updatedAt'    => $this->updated_at
        ];
    }
}
