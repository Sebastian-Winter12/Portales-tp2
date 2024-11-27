<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Age;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GamesController extends Controller
{
    public function index()
    {
        $allGames = Game::with(['age'])->get();

        return view('games.index', [
            'games' => $allGames
        ]);
    }

    public function home()
    {
        $allGames = Game::with(['age'])->get();

        return view('index', [
            'games' => $allGames
        ]);
    }


    public function view(int $id)
    {
        $game = Game::findOrFail($id);

        return view('games.view', [
            'game' => $game
        ]);
    }

    public function createForm()
    {
        return view('games.create-form',[
            'age' => Age::all()
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'title.required' => 'El título debe tener un valor',
            'price.required' => 'El precio debe tener un valor',
            'release_date.required' => 'La fecha de estreno debe tener un valor',
            'synopsis.required' => 'La sinopsis debe tener un valor',
            'game_type.required' => 'El tipo de juego debe ser seleccionado',
            'game_type.in' => 'El tipo de juego debe ser uno de los siguientes: Un solo jugador, Multijugador, Cooperativo',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'El archivo debe estar en formato JPEG, PNG, JPG, GIF o SVG.',
            'image.max' => 'La imagen no puede exceder los 2MB.'
        ]);

        $input = $request->only(['title', 'price', 'release_date', 'synopsis', 'game_type', 'age_fk', 'age_id', 'abbreviation']);

        try {
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'public');
                $input['image'] = $path;
            }

            Game::create($input);

            $feedbackMessage = 'El videojuego <b>"' . e($input['title']) . '"</b> se publicó con éxito.';
            if (isset($input['image'])) {
                $feedbackMessage .= ' La imagen se guardó correctamente.';
            } else {
                $feedbackMessage .= ' Sin imagen adjunta.';
            }

            return redirect()
                ->route('games.index')
                ->with('feedback.message', $feedbackMessage);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors('Ocurrió un error al intentar guardar el videojuego: ' . $e->getMessage());
        }

    }



    public function editForm(int $id)
    {
        return view('games.edit-form', [
            'age' => Age::all(),
            'game' => Game::findOrFail($id)
        ]);
    }

    public function editProcess(int $id, Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'release_date' => 'required|date',
            'synopsis' => 'required|min:3|max:255',
            'game_type' => 'required|in:Un solo jugador,Multijugador,Cooperativo',
            'image' => 'nullable|image|max:2048'
        ], [
            'title.required' => 'El título debe tener un valor',
            'price.required' => 'El precio debe tener un valor',
            'release_date.required' => 'La fecha de estreno debe tener un valor',
            'synopsis.required' => 'La sinopsis debe tener un valor',
            'game_type.required' => 'El tipo de juego debe ser seleccionado',
            'game_type.in' => 'El tipo de juego debe ser uno de los siguientes: Un solo jugador, Multijugador, Cooperativo',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.max' => 'La imagen no puede exceder los 2MB.'
        ]);

        $input = $request->only(['title', 'price', 'release_date', 'synopsis', 'game_type']);

        $game = Game::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::disk('public')->delete($game->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $input['image'] = $path;
        }

        $game->update($input);

        return redirect()
            ->route('games.index')
            ->with('feedback.message', 'El videojuego <b>"' . e($input['title']) . '"</b> se editó con éxito.');
    }


    public function deleteProcess(int $id)
    {
        $game = Game::findOrFail($id);

        if ($game->image) {
            Storage::disk('public')->delete($game->image);
        }

        $game->delete();

        return redirect()
            ->route('games.index')
            ->with('feedback.message', 'El videojuego <b>"' . e($game->title) . '"</b> se eliminó con éxito.');
    }

    protected function deleteImage($imagePath)
    {
    if ($imagePath && Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
    }
    }


    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('games.edit-form', compact('game'));
    }


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

    public function buy(int $id)
{
    $game = Game::findOrFail($id);

    $user = auth()->user();

    if ($user->games->contains($game)) {
        return redirect()->route('games.view', ['id' => $game->id])
                         ->with('error', 'Ya has comprado este juego.');
    }

    $user->games()->attach($game->id);

    return redirect()->route('games.buy', ['id' => $game->id]);
}

    public function buySuccess(int $id)
    {
        $game = Game::findOrFail($id);

        return view('games.buy', ['game' => $game]);
    }



    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'release_date' => 'required|date',
            'game_type' => 'required|string',
            'synopsis' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($game->image && file_exists(public_path($game->image))) {
                unlink(public_path($game->image));
            }

            $imagePath = $request->file('image')->store('games_images', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            $validatedData['image'] = $game->image;
        }

        $game->update($validatedData);

        return redirect()->route('games.index')->with('success', 'Juego actualizado con éxito');
    }
}
