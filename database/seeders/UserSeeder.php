<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends BaseSeeder
{
    protected function getClass(): string
    {
        return User::class;
    }

    protected function getData(): array
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
