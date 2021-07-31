<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RedirectSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoutSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(AdministrationSeeder::class);
    }
}
