<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'sebastian',
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'sebastian',
            'email' => 'sebastian.winter@davinci.edu.ar',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'mariano',
            'email' => 'mariano.buranits@davinci.edu.ar',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'usuario1',
            'email' => 'usuario1@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'usuario2',
            'email' => 'usuario2@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
        // User::factory(10)->create();
    }
}
