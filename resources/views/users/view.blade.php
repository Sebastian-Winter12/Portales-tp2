@extends('layouts.main')

@section('title', $user->name)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="mb-3">{{ $user->name }}</h1>

            <dl class="mb-3">
                <dt>Nombre</dt>
                <dd>{{ $user->name }}</dd>
                <dt>Email</dt>
                <dd>{{ $user->email }}</dd>
                <dt>Contraseña</dt>
                <dd>{{ $user->password }}</dd>
                <dt>Id</dt>
                <dd>{{ $user->id }}</dd>                
                <dt>Rol</dt>
                <dd>{{ $user->role }}</dd>
            </dl>

            <hr class="mb-3">

            <h2 class="mb-3">Compras realizadas</h2>
            @if ($user->reservations->isEmpty())
                <p class="text-muted">No hay compras registradas.</p>
            @else
                @php
                    // Calcular el total de juegos y el gasto total
                    $totalGames = $user->reservations->count();
                    $totalSpent = $user->reservations->sum(fn($reservation) => $reservation->game->price);
                @endphp

                <!-- Mostrar el total de juegos y el gasto total -->
                <div class="mb-3">
                    <strong>Total de juegos comprados:</strong> {{ $totalGames }}<br>
                    <strong>Total gastado:</strong> ${{ number_format($totalSpent, 2) }}
                </div>

                <!-- Listar los juegos comprados -->
                <ul class="list-group">
                    @foreach ($user->reservations as $reservation)
                        <li class="list-group-item">
                            <strong>{{ $reservation->game->title }}</strong> -
                            ${{ number_format($reservation->game->price, 2) }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

@endsection
