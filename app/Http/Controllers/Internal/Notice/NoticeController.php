<?php

namespace App\Http\Controllers\Internal\Notice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\NoticeResource;
use App\Models\Notice;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NoticeController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return NoticeResource::collection(Notice::all());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'priority' => 'required|integer|min:1|max:999',
            'title'    => 'required|string|max:255',
            'content'  => 'required|string'
        ]);

        try {
            Notice::create($data);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Der Hinweis wurde erstellt.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param Notice $notice
     * @return JsonResponse
     */
    public function update(Request $request, Notice $notice): JsonResponse
    {
        $data = $request->validate([
            'priority' => 'required|integer|min:1|max:999',
            'title'    => 'required|string|max:255',
            'content'  => 'required|string'
        ]);

        try {
            $notice->update($data);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Der Hinweis wurde bearbeitet.'
        ], Response::HTTP_OK);
    }

    /**
     * @param Notice $notice
     * @return JsonResponse
     */
    public function delete(Notice $notice): JsonResponse
    {
        try {
            $notice->delete();
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Der Hinweis wurde gelöscht.'
        ], Response::HTTP_OK);
    }
}
