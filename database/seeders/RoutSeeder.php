<?php

namespace Database\Seeders;

use App\Models\Rout;
use Exception;
use Illuminate\Support\Facades\Storage;

class RoutSeeder extends BaseSeeder
{
    protected string $model = Rout::class;
    protected array $keys = [
        'year'
    ];

    protected function data(): array
    {
        try {
            $json = Storage::disk('initial')->get('routs.json');
            return json_decode($json, true);
        } catch (Exception $exception) {
            return [];
        }
    }
}
