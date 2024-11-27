@extends('layouts.main')

@section('title', 'Editar noticia '.e($new->title))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-3">Editar noticia {{ $new->title }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    Hay errores en los datos del formulario, por favor revisarlos y volver a intentar
                </div>
            @endif

            <form action="{{ route('news.edit.process', ['id' => $new->news_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $new->title) }}">
                    @error('title')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Imagen</label>
                    <div class="d-flex align-items-center">
                        <input type="file" name="image" id="image" class="form-control me-3">
                        <img src="{{ Storage::url($new->image) }}" alt="{{ $new->title }}" class="img-thumbnail" style="width: 150px; height: 80px; object-fit: cover;">
                    </div>
                    @error('image')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="synopsis" class="form-label">Sinopsis</label>
                    <textarea name="synopsis" id="synopsis" class="form-control">{{ old('synopsis', $new->synopsis) }}</textarea>
                    @error('synopsis')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="journalist" class="form-label">Periodista</label>
                    <input type="text" name="journalist" id="journalist" class="form-control" value="{{ old('journalist', $new->journalist) }}">
                    @error('journalist')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>                     
                
                <div class="mb-3">
                    <label for="release_date" class="form-label">Fecha de lanzamiento</label>
                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date', $new->release_date->format('Y-m-d')) }}">
                
                    @error('release_date')
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
