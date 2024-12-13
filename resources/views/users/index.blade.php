@extends('layouts.main')

@section('title', 'Usuarios')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center mb-3">Listado de usuarios</h1>
            <div class="mb-3 text-center">
                <a class="bg-primary text-white text-decoration-none px-3 py-2 border rounded" href="{{ route('auth.create') }}"> Crear nuevo usuario </a>
            </div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="align-top">{{ $user->id }}</td> <!-- Cambiado user_id a id -->
                            <td class="align-top">{{ $user->name }}</td>
                            <td class="align-top">{{ $user->email }}</td>
                            <td class="align-top">******</td> <!-- Ocultar la contraseña -->
                            <td class="align-top">{{ $user->role }}</td>
                            <td class="align-top">
                                <a href="{{ route('users.view', ['id' => $user->id]) }}"
                                   class="btn btn-primary">Ver</a>
                                @auth
                                    <a href="{{ route('users.edit.form', ['id' => $user->id]) }}"
                                       class="btn btn-secondary ms-2">Editar</a>

                                    <form action="{{ route('users.delete.process', ['id' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" onclick="return confirm('Está seguro de borrar este usuario?')"
                                               class="btn btn-danger ms-2" value="Eliminar">
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
