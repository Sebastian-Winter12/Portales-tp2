<?php

namespace App\Http\Controllers;

use App\Mail\GameReservationConfirmation;
use App\Models\Game;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GamesReservationController extends Controller
{
    public function reservationProcess($id)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para reservar un juego.');
        }

        $game = Game::findOrFail($id);

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'reserved_at' => now(),
        ]);

        Mail::to($user->email)->send(new GameReservationConfirmation($game));

        return redirect()->route('games.index')->with('success', 'Reserva realizada con éxito.');
    }

    public function printEmail()
    {
        return new GameReservationConfirmation(Game::findOrFail(1));
    }
}
