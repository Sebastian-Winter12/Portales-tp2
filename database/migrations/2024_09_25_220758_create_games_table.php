<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->string('title', 100);
            $table->dateTime('release_date');
            $table->unsignedInteger('price');
            $table->string('image');
            $table->text('synopsis');
            $table->enum('game_type', ['Multijugador', 'Cooperativo', 'Un solo jugador'])->default('Un solo jugador');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
