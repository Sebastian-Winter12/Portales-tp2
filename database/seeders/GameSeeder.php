<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Game;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            [
                'age_fk' => 3,
                'title' => 'Assassins Creed Mirage',
                'image' => 'images/assassins.jpg',
                'release_date' => '2023-10-05',
                'price' => 5000,
                'synopsis' => 'Revive la Edad de Oro de Bagdad como un astuto asesino en esta nueva entrega de la serie.',
                'game_type' => 'Un solo jugador'
            ],
            [
                'age_fk' => 4,
                'title' => 'Baldurs Gate 3',
                'image' => 'images/baldurs.jpg',
                'release_date' => '2023-08-03',
                'price' => 6000,
                'synopsis' => 'Reúne a tu grupo y regresa a los Reinos Olvidados en una historia de compañerismo y traición.',
                'game_type' => 'Cooperativo'
            ],
            [
                'age_fk' => 1,
                'title' => 'Dragon Ball Sparking Zero',
                'image' => 'images/dragon-ball.jpg',
                'release_date' => '2024-01-01',
                'price' => 4500,
                'synopsis' => 'Una nueva entrega llena de energía de la serie Dragon Ball, con batallas intensas y personajes icónicos.',
                'game_type' => 'Multijugador'
            ],
            [
                'age_fk' => 4,
                'title' => 'Grand Theft Auto 6',
                'image' => 'images/gta.jpg',
                'release_date' => '2025-12-01',
                'price' => 7000,
                'synopsis' => 'Explora un vasto mundo abierto y vive tus fantasías criminales más salvajes en la última entrega de GTA.',
                'game_type' => 'Multijugador'
            ],
            [
                'age_fk' => 1,
                'title' => 'Hogwarts Legacy',
                'image' => 'images/hogwarts.jpg',
                'release_date' => '2023-02-10',
                'price' => 5000,
                'synopsis' => 'Vive la vida en Hogwarts en este inmersivo RPG ambientado en el Mundo Mágico.',
                'game_type' => 'Un solo jugador'
            ],
            [
                'age_fk' => 4,
                'title' => 'Mortal Kombat 1',
                'image' => 'images/mk.jpg',
                'release_date' => '2023-09-19',
                'price' => 4000,
                'synopsis' => 'Regresa al brutal y sangriento mundo de Mortal Kombat en este épico reinicio de la serie.',
                'game_type' => 'Multijugador'
            ],
            [
                'age_fk' => 2,
                'title' => 'Diablo IV',
                'image' => 'images/Diablo.jpg',
                'release_date' => '2023-06-06',
                'price' => 6500,
                'synopsis' => 'Enfréntate al regreso de Lilith y defiende el Santuario en este oscuro RPG de acción cooperativo.',
                'game_type' => 'Cooperativo'
            ],
            [
                'age_fk' => 1,
                'title' => 'Marvels Spider-Man 2',
                'image' => 'images/spiderman.jpg',
                'release_date' => '2023-10-20',
                'price' => 6000,
                'synopsis' => 'Lánzate a la acción como Spider-Man y enfréntate a nuevos enemigos en esta emocionante aventura de mundo abierto.',
                'game_type' => 'Un solo jugador'
            ],
            [
                'age_fk' => 2,
                'title' => 'Valorant',
                'image' => 'images/valorant.jpg',
                'release_date' => '2020-06-02',
                'price' => 0,
                'synopsis' => 'Participa en batallas tácticas 5v5 en este shooter competitivo basado en personajes.',
                'game_type' => 'Multijugador'
            ],
            [
                'age_fk' => 1,
                'title' => 'The Legend of Zelda: Tears of the Kingdom',
                'image' => 'images/zelda.jpg',
                'release_date' => '2023-05-12',
                'price' => 6500,
                'synopsis' => 'Explora un vasto y misterioso mundo en esta épica secuela de Breath of the Wild.',
                'game_type' => 'Un solo jugador'
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
