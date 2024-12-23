<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function view(int $id)
    {
        $user = User::findOrFail($id);

        return view('users.view', [
            'user' => $user
        ]);
    }

    public function registerForm()
    {
        return view('auth.register-form');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $input = $request->only(['name', 'email', 'password']);
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        Auth::login($user);

        return redirect()->route('home')->with('feedback.message', 'El usuario se creó con éxito.');
    }

    public function editForm(int $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit-form', [
            'user' => $user
        ]);
    }

    public function editProcess(int $id, Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::findOrFail($id);

        $input = $request->only(['name', 'email', 'role']);

        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $user->update($input);


        return redirect()
        ->route('admin.index')
        ->with('feedback.message', 'El usuario <b>"' . e($input['name']) . '"</b> se editó con éxito.');
    }

    public function deleteProcess(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('feedback.message', 'El usuario se eliminó con éxito.');
    }

    public function profile(int $id)
{
    $user = User::findOrFail($id);
    $games = Game::all();

    return view('profile.profile', [
        'user' => $user,
        'games' => $games
    ]);
}

}
