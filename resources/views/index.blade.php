@extends('layouts.main')

@section('title', 'Página de inicio')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center mt-5">Inicio</h1>
        </div>

        <div class="col-12 mt-4 mb-5">
            <div id="carouselGames" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($games as $index => $game)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="carousel-image-wrapper position-relative">
                            <img src="{{ Storage::url($game->image) }}" class="d-block w-100"
                                alt="{{ $game->title }}" style="height: 100vh; width: 100%; object-fit: cover;">
                            <div class="carousel-overlay position-absolute bottom-0 w-100" style="height: 20%; background: rgba(0, 0, 0, 0.7);">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $game->title }}</h5>
                                    <p>{{ $game->synopsis }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselGames" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselGames" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>

        @if($games->count() > 0)
        <div class="col-12 mb-5 mt-5">
            <div class="text-center">
                <h2 class="text-center">Juego destacado</h2>
                <img src="{{ Storage::url($games[0]->image) }}" class="card-img-top img-fluid"
                    alt="{{ $games[0]->title }}" 
                    style="width: 100%; height: 500px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="mt-4">{{ $games[0]->title }}</h4>
                    <p>{{ $games[0]->synopsis }}</p>
                    <p><strong>Precio:</strong> ${{ $games[0]->price }}</p>
                    <p><strong>Fecha de lanzamiento:</strong> {{ $games[0]->release_date }}</p>
                    <p><strong>Tipo de juego:</strong> {{ $games[0]->game_type }}</p>
                    <p><strong>Clasificación:</strong> {{ $games[0]->age->name }}</p>
                    <a href="{{ route('games.view', ['id' => $games[0]->id]) }}" 
                        class="btn btn-primary">Saber más</a>
                </div>
            </div>
        </div>
        @endif
        
        <div class="col-12">
            <h3 class="text-center mb-4 mt-5">Otros juegos</h3>
            <div class="row">
                @foreach ($games->skip(1) as $game)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ Storage::url($game->image) }}" class="card-img-top img-fluid"
                        alt="{{ $game->title }}" 
                        style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $game->title }}</h5>
                            <p class="card-text">{{ $game->synopsis }}</p>
                            <div class="d-flex justify-content-center">
                               <a href="{{ route('games.view', ['id' => $game->id]) }}" 
                                class="btn btn-primary">Saber más</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .carousel-image-wrapper {
        position: relative;
    }
    .carousel-overlay {
        background: rgba(0, 0, 0, 0.4);
        padding: 30px;
    }
</style>
@endpush
