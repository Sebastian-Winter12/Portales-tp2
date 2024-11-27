<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\News;

class GameFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        return [];
    }
}
