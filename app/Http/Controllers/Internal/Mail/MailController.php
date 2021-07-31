<?php

namespace App\Http\Controllers\Internal\Mail;

use App\Http\Controllers\Controller;
use App\Models\MailReceiverGroup;
use App\Traits\Functions\DecodeJson;
use App\Traits\Functions\SendMail;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    use SendMail,
        DecodeJson;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request): JsonResponse
    {
        $data = $request->validate([
            'subject'        => 'required|string',
            'content'        => 'required|string',
            'receivers'      => 'required|json',
            'receiverGroups' => 'required|json',
            'attachments'    => 'nullable|array',
            'attachments.*'  => 'file'
        ]);

        $jsonReceivers = $this->decodeJson($data['receivers']);
        $jsonReceiverGroups = $this->decodeJson($data['receiverGroups']);

        if ($jsonReceivers === null || $jsonReceiverGroups === null) {
            return response()->json([
                'message' => 'Fehlerhafte Anfrage.'
            ], Response::HTTP_CONFLICT);
        }

        $receivers = $this->getReceivers($jsonReceiverGroups, $jsonReceivers)->toArray();
        $attachments = Arr::has($data, 'attachments') ? $data['attachments'] : null;
        $this->sendMail($receivers, $data['subject'], $data['content'], $attachments);

        return response()->json([
            'message' => 'Die E-Mail wurde versandt.'
        ], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return Collection[]
     */
    public function receiverPreview(Request $request): array
    {
        $data = $request->validate([
            'receivers'        => 'nullable|array',
            'receivers.*'      => 'required|email',
            'receiverGroups'   => 'nullable|array',
            'receiverGroups.*' => 'required|int'
        ]);
        $this->addFields($data);

        return [
            'receivers' => $this->getReceivers(
                $data['receiverGroups'],
                $data['receivers']
            )
        ];
    }

    /**
     * @param array $receiverGroupIds
     * @param array $customReceivers
     * @return Collection
     */
    protected function getReceivers(array $receiverGroupIds, array $customReceivers): Collection
    {
        $receivers = collect($customReceivers);
        $receiverGroups = MailReceiverGroup::whereIn('id', $receiverGroupIds)->get();
        foreach ($receiverGroups as $receiverGroup) {
            try {
                $decoded = json_decode($receiverGroup->mail_receivers, true, 512, JSON_THROW_ON_ERROR);
                $receivers = $receivers->merge($decoded);
            } catch (Exception $exception) {
                // such emptiness
            }
        }
        return $receivers;
    }

    protected function addFields(&$data)
    {
        if (!Arr::exists($data, 'receivers')) {
            $data['receivers'] = [];
        }
        if (!Arr::exists($data, 'receiverGroups')) {
            $data['receiverGroups'] = [];
        }
    }
}
