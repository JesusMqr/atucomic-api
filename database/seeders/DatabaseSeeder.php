<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\Image;
use App\Models\Serie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@correo.es',
        ]);

        Serie::factory(12)->create();
        Chapter::factory(120)->create();
        Image::factory(2400)->create();
    }
}
