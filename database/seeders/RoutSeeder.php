<?php

namespace Database\Seeders;

use App\Models\Rout;
use Exception;
use Illuminate\Support\Facades\Storage;

class RoutSeeder extends BaseSeeder
{
    protected function getClass(): string
    {
        return Rout::class;
    }

    protected function getData(): array
    {
        try {
            $json = Storage::disk('initial')->get('routs.json');
            return json_decode($json, true);
        } catch (Exception $exception) {
            return [];
        }
    }
}
