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
        // Crear un administrador
        User::create([
            'name' => 'sebastian',
            'email' => 'test@test.com',
            'password' => Hash::make('password'), // Asegúrate de usar una contraseña cifrada
            'role' => 'admin', // Rol de administrador
        ]);

        // Crear usuarios normales
        User::create([
            'name' => 'usuario1',
            'email' => 'usuario1@example.com',
            'password' => Hash::make('password'), // Asegúrate de usar una contraseña cifrada
            'role' => 'user', // Rol de usuario
        ]);

        User::create([
            'name' => 'usuario2',
            'email' => 'usuario2@example.com',
            'password' => Hash::make('password'), // Asegúrate de usar una contraseña cifrada
            'role' => 'user', // Rol de usuario
        ]);

        // Puedes crear más usuarios si lo deseas

        // También puedes usar la factory si deseas generar muchos usuarios de manera aleatoria
        // User::factory(10)->create(); // Esto creará 10 usuarios de prueba
    }
}
