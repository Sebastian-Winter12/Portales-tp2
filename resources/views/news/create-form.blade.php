@extends('layouts.main')

@section('title', 'Publicar una nueva nota')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3">Publicar una nueva nota</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    Hay errores en los datos del formulario, por favor revisarlos y volver a intentar
                </div>
            @endif

            <form action="{{ route('news.create.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                    @error('title')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Imagen</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Sinopsis</label>
                    <textarea name="synopsis" id="synopsis" class="form-control">{{ old('synopsis') }}</textarea>
                    @error('synopsis')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="journalist" class="form-label">Periodista</label>
                    <input type="text" name="journalist" id="journalist" class="form-control" value="{{ old('journalist') }}">
                    @error('journalist')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="release_date" class="form-label">Fecha de lanzamiento</label>
                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date') }}">
                    @error('release_date')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    </div>
</div>

@endsection
