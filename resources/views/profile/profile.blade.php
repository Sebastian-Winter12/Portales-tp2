@extends('layouts.main')

@section('title', 'Perfil')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center mb-3">{{ $user->name }}</h1>

            <div class="text-center mb-4">
                <img src="{{ $user->profile_picture ? asset('storage/'.$user->profile_picture) : asset('images/default-avatar.jpg') }}" alt="Foto de perfil" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
            </div>

            <div class="mb-3">
                <p><strong>ID:</strong> {{ $user->id }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>

            <h2 class="mb-3">Compras realizadas</h2>
            @if ($user->reservations->isEmpty())
                <p class="text-muted">No hay compras registradas.</p>
            @else
                <ul class="list-group">
                    @foreach ($user->reservations as $reservation)
                        <li class="list-group-item">
                            <strong>{{ $reservation->game->title }}</strong> -
                            ${{ number_format($reservation->game->price, 2) }}
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="mb-3 text-center">
                <form action="{{ route('auth.logout.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4 py-2">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
