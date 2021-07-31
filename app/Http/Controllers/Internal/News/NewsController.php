<?php

namespace App\Http\Controllers\Internal\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\NewsResource;
use App\Models\News;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return NewsResource::collection(News::all());
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
            'imageUrl' => 'required|string|max:255',
            'content'  => 'required|string'
        ]);

        try {
            News::create([
                'priority'  => $data['priority'],
                'title'     => $data['title'],
                'image_url' => $data['imageUrl'],
                'content'   => $data['content']
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Neuigkeit wurde erstellt.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param News $news
     * @return JsonResponse
     */
    public function update(Request $request, News $news): JsonResponse
    {
        $data = $request->validate([
            'priority' => 'required|integer|min:1|max:999',
            'title'    => 'required|string|max:255',
            'imageUrl' => 'required|string|max:255',
            'content'  => 'required|string'
        ]);

        try {
            $news->update([
                'priority'  => $data['priority'],
                'title'     => $data['title'],
                'image_url' => $data['imageUrl'],
                'content'   => $data['content']
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Neuigkeit wurde bearbeitet.'
        ], Response::HTTP_OK);
    }

    /**
     * @param News $news
     * @return JsonResponse
     */
    public function delete(News $news): JsonResponse
    {
        try {
            $news->delete();
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Die Neuigkeit wurde gelöscht.'
        ], Response::HTTP_OK);
    }
}
