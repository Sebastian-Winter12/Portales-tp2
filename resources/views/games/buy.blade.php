@extends('layouts.main')

@section('title', 'Compra exitosa - ' . $game->title)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>

            <h1 class="mb-3">¡Compra exitosa!</h1>

            <div class="alert alert-success">
                <p>¡Felicidades! Has comprado el videojuego <strong>{{ $game->title }}</strong> por ${{ $game->price }}.</p>
                <p>Ahora puedes ver este juego en tu perfil de usuario.</p>
            </div>

            <hr class="mb-3">

            <div>
                <h3>Detalles del juego</h3>
                <dl class="mb-3">
                    <dt>Imagen</dt>
                    <dd><img src="{{ Storage::url($game->image) }}" class="card-img-top" alt="{{ $game->title }}"></dd>
                    <dt>Precio</dt>
                    <dd>${{ $game->price }}</dd>
                    <dt>Fecha de estreno</dt>
                    <dd>{{ $game->release_date }}</dd>
                    <dt>Modo de juego</dt>
                    <dd>{{ $game->game_type }}</dd>
                </dl>
            </div>

            <hr class="mb-3">

            <div>
                <h4>¿Qué deseas hacer ahora?</h4>
                <a href="{{ route('games.index') }}" class="btn btn-primary">Ver más videojuegos</a>
                <a href="{{ route('users.view', auth()->user()->id) }}" class="btn btn-secondary">Ir a mi perfil</a>
            </div>
        </div>
    </div>
</div>

@endsection
