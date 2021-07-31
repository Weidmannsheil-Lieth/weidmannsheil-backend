<?php

namespace App\Http\Controllers\Internal\GalleryAlbum;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\GalleryAlbumResource;
use App\Models\GalleryAlbum;
use App\Traits\Functions\GalleryItem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GalleryAlbumController extends Controller
{
    use GalleryItem;

    /**we
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return GalleryAlbumResource::collection(GalleryAlbum::orderBy('year', 'desc')->get());
    }

    /**
     * @param GalleryAlbum $galleryAlbum
     * @return GalleryAlbumResource
     */
    public function show(GalleryAlbum $galleryAlbum): GalleryAlbumResource
    {
        $galleryAlbum->loadMissing([
            'galleryImages' => static function ($query) {
                return $query->orderBy('created_at', 'desc');
            }
        ]);
        return new GalleryAlbumResource($galleryAlbum);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'year' => 'required|int',
            'name' => 'required|string|max:255'
        ]);

        if (GalleryAlbum::where('year', $data['year'])
            ->where('name', $data['name'])
            ->exists()
        ) {
            return response()->json([
                'message' => 'Es existiert schon ein Album mit diesen Daten.'
            ], Response::HTTP_CONFLICT);
        }

        try {
            $this->storeGalleryAlbum($data);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Das Album wurde erstellt.'
        ], Response::HTTP_CREATED);
    }

    /**
     * @param GalleryAlbum $galleryAlbum
     * @return JsonResponse
     */
    public function delete(GalleryAlbum $galleryAlbum): JsonResponse
    {
        try {
            $this->deleteGalleryAlbum($galleryAlbum);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Das Album und dessen Inhalte wurden gelöscht.'
        ], Response::HTTP_OK);
    }
}
