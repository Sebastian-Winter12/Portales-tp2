<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ages')->insert([
            [
                'name' => 'Apta Todo Público',
                'abbreviation' => 'ATP',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mayores de 13 años',
                'abbreviation' => 'M13',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mayores de 16 años',
                'abbreviation' => 'M16',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mayores de 18 años',
                'abbreviation' => 'M18',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
