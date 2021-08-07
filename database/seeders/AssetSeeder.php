<?php

namespace Database\Seeders;

use App\Models\Asset;

class AssetSeeder extends BaseSeeder
{
    protected function getClass(): string
    {
        return Asset::class;
    }

    protected function getData(): array
    {
        return [
            [
                'name' => 'Satzung',
                'path' => '/downloads/Satzung.pdf',
                'mime' => 'application/pdf'
            ],
            [
                'name' => 'Einwilligung Datenschutz',
                'path' => '/downloads/Einwilligung-Datenschutz.pdf',
                'mime' => 'application/pdf'
            ],
            [
                'name' => 'Einwilligung Datenschutz Unternehmen',
                'path' => '/downloads/Einwilligung-Datenschutz-Unternehmen.pdf',
                'mime' => 'application/pdf'
            ],
            [
                'name' => 'Probetraining Jugend',
                'path' => '/downloads/Probetraining-Jugend.pdf',
                'mime' => 'application/pdf'
            ],
            [
                'name' => 'Aufnahmeantrag',
                'path' => '/downloads/Aufnahmeantrag.pdf',
                'mime' => 'application/pdf'
            ],
            [
                'name' => 'Anhang Jugendliche Aufnahmeantrag',
                'path' => '/downloads/Anhang-Jugendliche-Aufnahmeantrag.pdf',
                'mime' => 'application/pdf'
            ],
            [
                'name' => 'SEPA',
                'path' => '/downloads/SEPA.pdf',
                'mime' => 'application/pdf'
            ],
            [
                'name' => 'Gespann',
                'path' => '/rout.jpg',
                'mime' => 'image/jpeg'
            ],
            [
                'name' => 'Jugendgespann',
                'path' => '/rout-youth.jpg',
                'mime' => 'image/jpeg'
            ]
        ];
    }
}
