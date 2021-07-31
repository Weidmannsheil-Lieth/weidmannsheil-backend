<?php

namespace App\Http\Resources\Internal;

use App\Traits\Functions\DecodeJson;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginLogResource extends JsonResource
{
    use DecodeJson;

    /**
     * Transform the resource into an array.
     *
     * @param  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'actionId'         => $this->action_id,
            'username'         => $this->username,
            'ipAddress'        => $this->ip_address,
            'ipAddressDetails' => $this->decodeJson($this->ip_address_details),
            'createdAt'        => $this->created_at,
            'updatedAt'        => $this->updated_at,
        ];
    }
}
