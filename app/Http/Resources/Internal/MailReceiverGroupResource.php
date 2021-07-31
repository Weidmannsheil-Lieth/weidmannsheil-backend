<?php

namespace App\Http\Resources\Internal;

use App\Traits\Functions\DecodeJson;
use Illuminate\Http\Resources\Json\JsonResource;

class MailReceiverGroupResource extends JsonResource
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
        $mailReceivers = $this->decodeJson($this->mail_receivers);

        return [
            'id'                 => $this->id,
            'name'               => $this->name,
            'createdAt'          => $this->created_at,
            'updatedAt'          => $this->updated_at,

            'mailReceivers'      => $mailReceivers,
            'mailReceiversCount' => $mailReceivers ? count($mailReceivers) : 0,
        ];
    }
}
