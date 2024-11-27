<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Elden Ring 2 se lleva el GOTY 2025',
                'image' => 'images/noticia1.webp',
                'journalist' => 'María Gómez',
                'synopsis' => 'FromSoftware lo hace de nuevo con una secuela épica que redefine el género RPG de mundo abierto.',
                'release_date' => '2025-11-15'
            ],
            [
                'title' => 'Fnatic se corona campeón mundial de League of Legends 2024',
                'image' => 'images/noticia2.webp',
                'journalist' => 'Carlos Sánchez',
                'synopsis' => 'Fnatic vence a T1 en una final histórica, marcando un hito en los esports.',
                'release_date' => '2024-11-05'
            ],
            [
                'title' => 'Starfield 2 anunciado en el E3 2025',
                'image' => 'images/noticia3.webp',
                'journalist' => 'Laura Martínez',
                'synopsis' => 'Bethesda sorprende a los fanáticos con la secuela del popular RPG espacial.',
                'release_date' => '2025-12-10'
            ],
            [
                'title' => 'The Last of Us Parte 3 es oficialmente anunciado',
                'image' => 'images/noticia4.webp',
                'journalist' => 'Javier Pérez',
                'synopsis' => 'Naughty Dog regresa con la esperada tercera parte de la saga postapocalíptica.',
                'release_date' => '2024-06-20'
            ],
            [
                'title' => 'GTA VI establece récord de ventas en 24 horas',
                'image' => 'images/gta.jpg',
                'journalist' => 'Ana Rodríguez',
                'synopsis' => 'Rockstar lanza la esperada entrega de la serie y rompe todas las marcas de ventas globales.',
                'release_date' => '2025-03-25'
            ],
            [
                'title' => 'Counter-Strike 2: Nueva era de los esports',
                'image' => 'images/noticia5.jpg',
                'journalist' => 'Diego Fernández',
                'synopsis' => 'Valve reinventa el clásico shooter con gráficos mejorados y un nuevo sistema competitivo.',
                'release_date' => '2024-08-17'
            ],
            [
                'title' => 'Zelda: Tears of the Kingdom recibe DLC “Legado de Hyrule”',
                'image' => 'images/zelda.jpg',
                'journalist' => 'Lucía Ramírez',
                'synopsis' => 'Expande la aventura épica con una historia inédita y nuevas regiones por explorar.',
                'release_date' => '2024-10-30'
            ],
            [
                'title' => 'PGL Major París 2024: Cloud9 logra la victoria',
                'image' => 'images/noticia6.jpg',
                'journalist' => 'Alejandro Ruiz',
                'synopsis' => 'Cloud9 se alza campeón en un evento lleno de sorpresas y jugadas impresionantes.',
                'release_date' => '2024-05-22'
            ],
            [
                'title' => 'Metroid Prime 4: Nintendo deslumbra en los Game Awards 2024',
                'image' => 'images/noticia7.jpg',
                'journalist' => 'Paula Torres',
                'synopsis' => 'El esperado regreso de Samus Aran es aclamado como una obra maestra.',
                'release_date' => '2024-12-05'
            ],
        ];
        

        foreach ($news as $new) {
            News::create($new);
        }
    }
}
