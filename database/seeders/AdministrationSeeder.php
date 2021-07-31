<?php

namespace Database\Seeders;

use App\Models\Administration;

class AdministrationSeeder extends BaseSeeder
{
    protected function getClass(): string
    {
        return Administration::class;
    }

    protected function getData(): array
    {
        return [
            [
                'priority' => 100,
                'name'     => 'Vorsitzende',
                'members'  => "Sabine Nickel\nWolfgang Vollstedt",
                'email'    => 'vorstand@weidmannsheil-lieth.de'
            ],
            [
                'priority' => 95,
                'name'     => 'Kasse',
                'members'  => "Torben Sbresny\nKarl Ludwig Overkamp",
                'email'    => 'kasse@weidmannsheil-lieth.de'
            ],
            [
                'priority' => 90,
                'name'     => 'Presse',
                'members'  => "Julika Merz\nLennard Nickel",
                'email'    => 'presse@weidmannsheil-lieth.de'
            ],
            [
                'priority' => 85,
                'name'     => 'Sportwarte',
                'members'  => "Arne Hauenstein\nStefan Mohr\nJan Sbresny",
                'email'    => 'sportwart@weidmannsheil-lieth.de'
            ],
            [
                'priority' => 80,
                'name'     => 'Jugendwarte',
                'members'  => "Daniela Vollstedt\nFinn-Ole Merz\nLennard Nickel",
                'email'    => 'jugendwart@weidmannsheil-lieth.de'
            ],
            [
                'priority' => 75,
                'name'     => 'Schrift',
                'members'  => "Daniela Vollstedt\nKathrin Heilmann\n\n",
                'email'    => 'schrift@weidmannsheil-lieth.de'
            ],
        ];
    }
}
