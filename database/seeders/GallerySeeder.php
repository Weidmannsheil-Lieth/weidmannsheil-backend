<?php

namespace Database\Seeders;

use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GallerySeeder extends Seeder
{
    protected string $disk = 'gallery';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            GalleryImage::query()->delete();
            GalleryAlbum::query()->delete();
        } catch (Exception $exception) {
            return;
        }

        foreach ($this->getYearFolders() as $yearFolder) {
            foreach ($this->getAlbumFolders($yearFolder) as $albumFolder) {
                $name = Str::after($this->convertEncoding($albumFolder), '/');
                echo "Auslesen: " . $name . "\n";

                $galleryAlbum = GalleryAlbum::create([
                    'year' => $yearFolder,
                    'name' => $name
                ]);

                foreach ($this->getGalleryImages($albumFolder) as $image) {
                    $galleryAlbum->galleryImages()->create([
                        'path' => $this->convertEncoding($image)
                    ]);
                }
            }
        }
    }

    /**
     * @return array
     */
    protected function getYearFolders(): array
    {
        return Storage::disk($this->disk)->directories();
    }

    /**
     * @param string $yearFolder
     * @return array
     */
    protected function getAlbumFolders(string $yearFolder): array
    {
        return Storage::disk($this->disk)->directories($yearFolder);
    }

    /**
     * @param string $albumFolder
     * @return array
     */
    protected function getGalleryImages(string $albumFolder): array
    {
        return Storage::disk($this->disk)->files($albumFolder);
    }

    /**
     * @param string $string
     * @return string
     */
    protected function convertEncoding(string $string): string
    {
        return mb_convert_encoding($string, 'UTF-8');
    }
}
