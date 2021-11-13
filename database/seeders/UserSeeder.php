<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends BaseSeeder
{
    protected string $model = User::class;
    protected array $keys = [
        'username'
    ];

    protected function data(): array
    {
        return [
            [
                'abbreviation' => 'WB',
                'username'     => 'webmaster',
                'name'         => "Webmaster",
                'email'        => "webmaster@weidmannsheil-lieth.de",
                'password'     => Hash::make('change')
            ]
        ];
    }
}
