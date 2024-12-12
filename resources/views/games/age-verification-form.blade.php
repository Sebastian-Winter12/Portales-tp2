@extends('layouts.main')

@section('title', 'verificacion de edad')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3">Confirmacion necesaria</h1>
            <p class="mb-3"><b>{{ $game->title }}</b> está marcada como solo apto para mayores de 18 años, Para acceder, es necesario que nos confirmes que cumples con este requisito</p>

            <form action="{{ route('movies.age-verification.process', ['id' => $game->id]) }}" method="POST">
                @csrf
                <a href="{{ route('movies.index') }}" class="btn btn-danger" >No, soy menor de edad ¡Saquenme de aqui!</a>
                <button type="submit" class="btn btn-primary">Sí, soy mayor de edad</button>
            </form>

        </div>
    </div>
</div>


@endsection
