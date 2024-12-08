<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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

    public function createForm()
    {
        return view('users.create-form');
    }

    public function createProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:user,admin',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'role.required' => 'El rol es obligatorio.',
            'role.in' => 'El rol debe ser "user" o "admin".',
        ]);

        $input = $request->only(['name', 'email', 'password', 'role']);
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        return redirect()
        ->route('users.view', ['id' => $user->id])
        ->with('feedback.message', 'El usuario se creó con éxito.');
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
            'role' => 'required|in:user,admin',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'role.required' => 'El rol es obligatorio.',
            'role.in' => 'El rol debe ser "user" o "admin".',
        ]);

        $user = User::findOrFail($id);

        $input = $request->only(['name', 'email', 'role']);

        if ($request->filled('password')) {
            $input['password'] = Hash::make($request->password);
        }

        $user->update($input);

        return redirect()
        ->route('users.view', ['id' => $user->id])
            ->with('feedback.message', 'El usuario se editó con éxito.');
    }

    public function deleteProcess(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('feedback.message', 'El usuario se eliminó con éxito.');
    }
}
