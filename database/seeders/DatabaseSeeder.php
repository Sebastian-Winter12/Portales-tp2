<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Game;
use App\Models\News;

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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Game::factory(10)->create();
        // News::factory(10)->create();
        $this->call([
            AgeSeeder::class,
            NewsSeeder::class,
            UserSeeder::class,
            GameSeeder::class
        ]);
    }
}
