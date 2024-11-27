@extends('layouts.main')

@section('title', 'Videojuegos')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center mb-3">Listado de videojuegos</h1>
            <div class="mb-3 text-center">
                <a class="bg-primary text-white text-decoration-none px-3 py-2 border rounded " href="{{ route('games.create.form') }}"> Publicar un nuevo juego </a>
            </div>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Fecha de estreno</th>
                        <th>Precio</th>
                        <th>Sinopsis</th>
                        <th>Modo de juego</th>
                        <th>Clasificación</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($games as $game)
                        <tr>
                            <td class="align-top">{{ $game->game_id }}</td>
                            <td class="align-top"><img src="{{ Storage::url($game->image) }}" class="card-img-top"
                                alt="{{ $game->title }}" class="img-fluid" 
                                style="width: 150px; height: 80px; object-fit: cover;"></td>
                            <td class="align-top">{{ $game->title }}</td>
                            <td class="align-top">{{ $game->release_date }}</td>
                            <td class="align-top">{{ $game->price }}</td>
                            <td class="align-top">{{ $game->synopsis }}</td>
                            <td class="align-top">{{ $game->game_type }}</td>
                            <td>{{ $game->age->name }}</td>
                            <td class="align-top">
                                <a href="{{ route('games.view', ['id' => $game->game_id]) }}" 
                                class="btn btn-primary">Ver</a>
                                @auth
                                    <a href="{{ route('games.edit.form', ['id' => $game->game_id]) }}" 
                                    class="btn btn-secondary ms-2">Editar</a>

                                    <form action="{{ route('games.delete.process', ['id' => $game->game_id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" onclick="return confirm('Está seguro de borrar el videojuego?')"
                                            class="btn btn-danger ms-2" value="Eliminar">
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach

                    
                </thead>
            </table>
        </div>
    </div>
</div>



@endsection