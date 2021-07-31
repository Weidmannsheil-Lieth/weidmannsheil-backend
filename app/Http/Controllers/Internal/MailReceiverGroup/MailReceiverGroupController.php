<?php

namespace App\Http\Controllers\Internal\MailReceiverGroup;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\MailReceiverGroupResource;
use App\Models\MailReceiverGroup;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class MailReceiverGroupController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MailReceiverGroupResource::collection(MailReceiverGroup::all());
    }

    /**
     * @param MailReceiverGroup $mailReceiverGroup
     * @return MailReceiverGroupResource
     */
    public function show(MailReceiverGroup $mailReceiverGroup): MailReceiverGroupResource
    {
        $mailReceiverGroup->loadMissing('mailReceivers');
        return new MailReceiverGroupResource($mailReceiverGroup);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'mailReceivers' => 'required|json',
        ]);

        try {
            MailReceiverGroup::create([
                'name'           => $data['name'],
                'mail_receivers' => $data['mailReceivers']
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Gruppe wurde erstellt.'
        ]);
    }

    /**
     * @param Request $request
     * @param MailReceiverGroup $mailReceiverGroup
     * @return JsonResponse
     */
    public function update(Request $request, MailReceiverGroup $mailReceiverGroup): JsonResponse
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'mailReceivers' => 'required|json',
        ]);

        try {
            $mailReceiverGroup->update([
                'name'           => $data['name'],
                'mail_receivers' => $data['mailReceivers']
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Gruppe wurde bearbeitet.'
        ]);
    }

    /**
     * @param MailReceiverGroup $mailReceiverGroup
     * @return JsonResponse
     */
    public function delete(MailReceiverGroup $mailReceiverGroup): JsonResponse
    {
        try {
            $mailReceiverGroup->delete();
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Gruppe wurde gelöscht.'
        ], Response::HTTP_OK);
    }
}
