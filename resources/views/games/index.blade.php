@extends('layouts.main')

@section('title', 'Videojuegos')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center mb-3">Listado de videojuegos</h1>
            
            <div class="row">
                @foreach ($games as $game)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <img src="{{ Storage::url($game->image) }}" class="card-img-top img-fluid"
                                 alt="{{ $game->title }}"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $game->title }}</h5>
                                <p class="card-text">{{ $game->synopsis }}</p>
                                <p><strong>Precio:</strong> ${{ $game->price }}</p>
                                <div class="d-flex justify-content-center mt-auto">
                                    <a href="{{ route('games.view', ['id' => $game->id]) }}" class="btn btn-primary">Saber más</a>
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
