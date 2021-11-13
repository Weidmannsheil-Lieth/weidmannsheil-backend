<?php

namespace Database\Seeders;

use App\Models\Redirect;

class RedirectSeeder extends BaseSeeder
{
    protected string $model = Redirect::class;
    protected array $keys = [
        'id'
    ];

    protected function data(): array
    {
        return [
            [
                'id'      => 1,
                'link'    => 'http://www.unesco.de/kultur/immaterielles-kulturerbe/bundesweites-verzeichnis/eintrag/schuetzenwesen-in-deutschland.html',
                'comment' => null
            ], [
                'id'      => 2,
                'link'    => 'http://www.kreisschuetzenverband-pinneberg.de/',
                'comment' => null
            ], [
                'id'      => 3,
                'link'    => 'https://shop.spreadshirt.net/lieth/',
                'comment' => null
            ], [
                'id'      => 4,
                'link'    => 'https://www.dsb.de/',
                'comment' => null
            ], [
                'id'      => 5,
                'link'    => 'https://www.ndsb-sh.de/',
                'comment' => null
            ], [
                'id'      => 6,
                'link'    => 'https://www.klein-nordende.de/',
                'comment' => null
            ], [
                'id'      => 7,
                'link'    => 'https://feuerwehr-klein-nordende.de/',
                'comment' => null
            ], [
                'id'      => 8,
                'link'    => 'http://www.stueben-muehle.de/',
                'comment' => null
            ], [
                'id'      => 9,
                'link'    => 'http://www.weersgmbh.de/',
                'comment' => null
            ], [
                'id'      => 10,
                'link'    => 'https://www.krsv.de/',
                'comment' => null
            ], [
                'id'      => 11,
                'link'    => 'https://www.sv-rellingen.de/',
                'comment' => null
            ], [
                'id'      => 12,
                'link'    => 'https://gilde-elmshorn.de/',
                'comment' => null
            ],
            [
                'id'      => 13,
                'link'    => 'http://www.sv-wilhelm-tell.de/',
                'comment' => null
            ],
            [
                'id'      => 14,
                'link'    => 'https://schuetzenverein-trendelburg.de/',
                'comment' => null
            ],
        ];
    }
}
