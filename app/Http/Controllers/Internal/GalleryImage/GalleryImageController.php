<?php

namespace App\Http\Controllers\Internal\GalleryImage;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Traits\Functions\GalleryItem;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GalleryImageController extends Controller
{
    use GalleryItem;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'albumId' => 'required|int',
            'image'   => 'required|file|mimes:jpg,png,gif'
        ]);

        try {
            $this->storeGalleryImage([
                'gallery_album_id' => $data['albumId'],
                'image'            => $data['image']
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
           'message' => 'Das Bild wurde gespeichert.'
        ], Response::HTTP_OK);
    }

    /**
     * @param GalleryImage $galleryImage
     * @return JsonResponse
     */
    public function delete(GalleryImage $galleryImage): JsonResponse
    {
        try {
            $this->deleteGalleryImage($galleryImage);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Es ist ein Fehler aufgetreten.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'message' => 'Das Bild wurde gelöscht.'
        ], Response::HTTP_OK);
    }
}
