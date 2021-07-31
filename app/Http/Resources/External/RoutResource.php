<?php

namespace App\Http\Resources\External;

use Illuminate\Http\Resources\Json\JsonResource;

class RoutResource extends JsonResource
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
            'year'             => $this->year,
            'king'             => $this->king,
            'firstKnight'      => $this->first_knight,
            'secondKnight'     => $this->second_knight,
            'youthKing'        => $this->youth_king,
            'citizenKing'      => $this->citizen_king,
            'citizenYouthKing' => $this->citizen_youth_king
        ];
    }
}
