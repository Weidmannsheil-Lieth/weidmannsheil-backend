<?php

namespace App\Http\Resources\Internal;

use App\Traits\Functions\DecodeJson;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
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
            'id'         => $this->id,
            'activityId' => $this->activity_id,
            'userId'     => $this->user_id,
            'modelType'  => $this->model_type,
            'modelId'    => $this->model_id,
            'content'    => $this->decodeJson($this->content),
            'createdAt'  => $this->created_at,
            'updatedAt'  => $this->updated_at,

            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
