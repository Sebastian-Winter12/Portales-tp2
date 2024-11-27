@extends('layouts.main')

@section('title', $game->title)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="mb-3">{{ $game->title }}</h1>

            <dl class="mb-3">
                <dt>Imagen {{ $game->title }}</dt>
                <dd><img src="{{ Storage::url($game->image) }}" class="card-img-top"
                    alt="{{ $game->title }}"></dd>
                <dt>Precio</dt>
                <dd>${{ $game->price }}</dd>
                <dt>Fecha de estreno</dt>
                <dd>{{ $game->release_date }}</dd>
                <dt>Modo de juego</dt>
                <dd>{{ $game->game_type }}</dd>
            </dl>

            <hr class="mb-3">

            <h2 class="mb-3">Sinopsis</h2>
            <p>{{ $game->synopsis }}</p>

            <hr class="mb-3">

            @if(auth()->check() && !auth()->user()->games->contains($game))

            <form action="{{ route('games.buy', ['id' => $game->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Comprar</button>
            </form>

            @endif




        </div>
    </div>
</div>
@endsection
