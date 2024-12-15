@extends('layouts.main')

@section('title', 'Noticias')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center mb-3">Nuestras noticias</h1>
            
            <div class="row">
                @foreach ($news as $new)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 d-flex flex-row">
                            <img src="{{ Storage::url($new->image) }}" class="img-fluid" alt="{{ $new->title }}"
                                 style="width: 300px; height: 300px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $new->title }}</h5>
                                <p class="card-text">{{ $new->synopsis }}</p>
                                <div class="d-flex justify-content-center mt-auto">
                                    <a href="{{ route('news.view', ['id' => $new->news_id]) }}" class="btn btn-primary">Ver</a>
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
