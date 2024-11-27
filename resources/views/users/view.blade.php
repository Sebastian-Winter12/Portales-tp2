@extends('layouts.main')

@section('title', $user->name)

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

            <h3>Compras Realizadas</h3>
            <ul>
                @foreach($user->purchases as $purchase)
                    <li>
                        {{ $purchase->game->title }} - ${{ $purchase->game->price }} 
                        <small>({{ $purchase->created_at->format('d/m/Y') }})</small>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>
@endsection
