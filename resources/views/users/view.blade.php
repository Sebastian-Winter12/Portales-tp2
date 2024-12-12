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
                <dt>Rol</dt>
                <dd>{{ $user->role }}</dd>
            </dl>

            <hr class="mb-3">

            <h2 class="mb-3">Compras realizadas</h2>
            @if ($user->reservations->isEmpty())
                <p class="text-muted">No hay compras registradas.</p>
            @else
                <ul class="list-group">
                    @foreach ($user->reservations as $reservation)
                    {{-- {{ dd($reservation) }} --}}
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
