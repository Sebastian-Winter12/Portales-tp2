<?php

namespace App\Http\Controllers;

use App\Mail\GameReservationConfirmation;
use App\Models\Game;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class GamesReservationController extends Controller
{
    public function reservationProcess(Request $request, $gameId)
    {


        $game = Game::findOrFail($gameId);


        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'game_id' => $game->game_id,
            'reserved_at' => now(),
        ]);

        \Mail::to(auth()->user()->email)->send(new GameReservationConfirmation($game));

        return redirect()->route('games.index')->with('success', 'Reserva realizada con éxito.');
    }

    public function printEmail()
    {
        return new GameReservationConfirmation(
            Game::findOrFail(1)
        );
    }
}
