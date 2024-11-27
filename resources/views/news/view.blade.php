@extends('layouts.main')

@section('title', $new->title)

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="mb-3">{{ $new->title }}</h1>
            <dl class="mb-3">
                <dt>Imagen {{ $new->title }}</dt>
                <dd><img src="{{ Storage::url($new->image) }}" class="card-img-top"
                    alt="{{ $new->title }}"></dd>
                    <dt>Periodista</dt>
                    <dd>{{ $new->journalist }}</dd>
                <dt>Fecha de estreno</dt>
                <dd>{{ $new->release_date }}</dd>
            </dl>

            <hr class="mb-3">

            <h2 class="mb-3"> Sinposis</h2>
            <p>{{ $new->synopsis }}</p>
        <div>
    </div>

@section('content')
