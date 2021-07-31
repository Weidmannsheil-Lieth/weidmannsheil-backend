<?php

namespace App\Http\Controllers\External\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Resources\External\GalleryAlbumResource;
use App\Models\GalleryAlbum;
use Illuminate\Support\Collection;

class GalleryController extends Controller
{
    /**
     * @return Collection
     */
    public function index(): Collection
    {
        $return = collect([]);

        $albums = GalleryAlbum::with('galleryImages')
            ->orderByDesc('year')
            ->get();

        $data = $albums->groupBy('year')
            ->map(static function ($album) {
                return GalleryAlbumResource::collection($album);
            });

        $data->keys()->each(static function ($key) use ($data, $return) {
            $return->push([
                'year'   => $key,
                'albums' => $data[$key]
            ]);
        });

        return $return;
    }
}
