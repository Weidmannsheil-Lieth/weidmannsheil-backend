<?php

namespace App\Traits\Functions;

use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait GalleryItem
{
    protected string $galleryDisk = 'gallery';

    /**
     * @param array $data
     * @throws Exception
     */
    protected function storeGalleryImage(array $data)
    {
        $id = GalleryImage::max('id') + 1;
        $album = GalleryAlbum::find($data['gallery_album_id']);
        if (!$album) {
            throw new Exception('Album could not be found.');
        }

        $albumPath = $album->year . '/' . $album->name;
        $imageName = $id . '.' . $data['image']->extension();
        if (!Storage::disk($this->galleryDisk)->putFileAs($albumPath, $data['image'], $imageName)) {
            throw new Exception('Image could not be stored.');
        }

        GalleryImage::create([
            'id'               => $id,
            'gallery_album_id' => $data['gallery_album_id'],
            'path'             => $albumPath . '/' . $imageName
        ]);
    }

    /**
     * @param array $data
     * @throws Exception
     */
    protected function storeGalleryAlbum(array $data)
    {
        $path = $data['year'] . '/' . $data['name'];

        if (!Storage::disk($this->galleryDisk)->exists($path)) {
            Storage::disk($this->galleryDisk)->makeDirectory($path);
        }

        if (!Storage::disk($this->galleryDisk)->exists($path)) {
            throw new Exception('Album folder could not be created: ' . $path);
        }

        GalleryAlbum::create($data);
    }

    /**
     * @param GalleryAlbum $album
     * @throws Exception
     */
    protected function deleteGalleryAlbum(GalleryAlbum $album)
    {
        $album->galleryImages()->delete();
        $album->delete();
        $this->deleteGalleryAlbumFolder($album);
    }

    /**
     * @param GalleryImage $galleryImage
     * @throws Exception
     */
    protected function deleteGalleryImage(GalleryImage $galleryImage)
    {
        $galleryImage->delete();
        $this->deleteGalleryImageFile($galleryImage->path);
    }

    /**
     * @param string $imagePath
     */
    protected function deleteGalleryImageFile(string $imagePath)
    {
        if (!Storage::disk($this->galleryDisk)->delete($imagePath)) {
            Log::alert('Image could not be deleted: ' . $imagePath);
        }
    }

    /**
     * @param $album
     */
    protected function deleteGalleryAlbumFolder($album)
    {
        $name = $album->year . '/' . $album->name;
        if (!Storage::disk($this->galleryDisk)->deleteDirectory($name)) {
            Log::alert('Album folder could not be deleted: ' . $name);
        }
    }
}
