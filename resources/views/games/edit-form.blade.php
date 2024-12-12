@extends('layouts.main')

@section('title', 'Editar videojuego '.e($game->title))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3">Editar videojuego {{ $game->title }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    Hay errores en los datos del formulario, por favor revisarlos y volver a intentar
                </div>
            @endif

            <form action="{{ route('games.edit.process', ['id' => $game->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $game->title) }}">
                    @error('title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="price" class="form-label">Precio</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $game->price) }}">
                    @error('price')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="release_date" class="form-label">Fecha de lanzamiento</label>
                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date', $game->release_date->format('Y-m-d')) }}">

                    @error('release_date')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="game_type" class="form-label">Tipo de juego</label>
                    <select name="game_type" id="game_type" class="form-control">
                        <option value="Un solo jugador" {{ old('game_type', $game->game_type) == 'Un solo jugador' ? 'selected' : '' }}>Un solo jugador</option>
                        <option value="Multijugador" {{ old('game_type', $game->game_type) == 'Multijugador' ? 'selected' : '' }}>Multijugador</option>
                        <option value="Cooperativo" {{ old('game_type', $game->game_type) == 'Cooperativo' ? 'selected' : '' }}>Cooperativo</option>
                    </select>
                    @error('game_type')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="age_fk" class="form-label">Clasificacion</label>
                        <select name="age_fk" id="age_fk" class="form-control">
                            @foreach ($age as $age)
                                <option value="{{ $age->age_id }}"
                                    @selected($age->age_id == old('age_fk', $game->age_fk))>
                                    {{ $age->name }} - {{ $age->abbreviation }}
                                </option> 
                            @endforeach
                        </select>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Imagen</label>
                    <div class="d-flex align-items-center">
                        <input type="file" name="image" id="image" class="form-control me-3">
                        <img src="{{ Storage::url($game->image) }}" alt="{{ $game->title }}" class="img-thumbnail" style="width: 150px; height: 80px; object-fit: cover;">
                    </div>
                    @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Sinopsis</label>
                    <textarea name="synopsis" id="synopsis" class="form-control">{{ old('synopsis', $game->synopsis) }}</textarea>
                    @error('synopsis')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('img.img-thumbnail').src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
