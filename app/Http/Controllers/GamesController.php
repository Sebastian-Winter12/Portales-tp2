<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Age;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GamesController extends Controller
{
    // Muestra todos los juegos en la vista principal
    public function index()
    {
        $allGames = Game::with(['age'])->get();

        return view('games.index', [
            'games' => $allGames
        ]);
    }

    // Muestra los juegos en la vista de inicio
    public function home()
    {
        $allGames = Game::with(['age'])->get();

        return view('index', [
            'games' => $allGames
        ]);
    }

    // Muestra los detalles de un juego específico
    public function view(int $id)
    {
        $game = Game::with('age')->findOrFail($id);

        return view('games.view', [
            'game' => $game
        ]);
    }

    // Muestra el formulario de creación de un juego
    public function createForm()
    {
        return view('games.create-form', [
            'ages' => Age::all()
        ]);
    }

    public function createProcess(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'release_date' => 'required|date',
            'synopsis' => 'required|min:3|max:255',
            'game_type' => 'required|in:Un solo jugador,Multijugador,Cooperativo',
            'age_fk' => 'required|exists:ages,age_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->only([
            'title', 'price', 'release_date', 'synopsis', 'game_type'
        ]);
        
        $input['age_id'] = $request->input('age_fk');
        

        if ($request->hasFile('image')) {
            $input['image'] = $this->handleImageUpload($request);
        }

        Game::create($input);

        return redirect()
            ->route('games.index')
            ->with('feedback.message', 'El videojuego se creó con éxito.');
    }

    // Muestra el formulario de edición de un juego
    public function editForm(int $id)
    {
        return view('games.edit-form', [
            'game' => Game::findOrFail($id),
            'ages' => Age::all()
        ]);
    }

    // Procesa la edición de un juego
    public function editProcess(int $id, Request $request)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'title' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'release_date' => 'required|date',
            'synopsis' => 'required|min:3|max:255',
            'game_type' => 'required|in:Un solo jugador,Multijugador,Cooperativo',
            'age_fk' => 'required|exists:ages,age_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input = $request->only([
            'title', 'price', 'release_date', 'synopsis', 'game_type'
        ]);
        
        $input['age_id'] = $request->input('age_fk');

        $input['image'] = $this->handleImageUpload($request, $game->image);

        $game->update($input);

        return redirect()
            ->route('games.index')
            ->with('feedback.message', 'El videojuego se actualizó con éxito.');
    }

    // Procesa la eliminación de un juego
    public function deleteProcess(int $id)
    {
        $game = Game::findOrFail($id);

        if ($game->image) {
            $this->deleteImage($game->image);
        }

        $game->delete();

        return redirect()
            ->route('games.index')
            ->with('feedback.message', 'El videojuego se eliminó con éxito.');
    }

    // Procesa la compra de un juego
    public function buy(Game $game)
    {
        $user = auth()->user();
        $user->games()->attach($game->id);

        return redirect()->route('games.view', $game)
            ->with('success', 'Juego comprado exitosamente.');
    }

    // Maneja la subida de imágenes
    protected function handleImageUpload(Request $request, $existingImage = null)
    {
        if ($request->hasFile('image')) {
            if ($existingImage) {
                $this->deleteImage($existingImage);
            }
            return $request->file('image')->store('images', 'public');
        }

        return $existingImage;
    }

    // Elimina una imagen almacenada
    protected function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
