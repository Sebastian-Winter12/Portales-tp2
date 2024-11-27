@extends('layouts.main')

@section('title', 'Videojuegos')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center mb-3">Nuestras noticias</h1>
            <div class="mb-3 text-center">
                <a class="bg-primary text-white text-decoration-none px-3 py-2 border rounded " href="{{ route('news.create.form') }}"> Publicar una nueva nota </a>
            </div>
            
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Imagen</th>
                        <th>Sinopsis</th>
                        <th>Periodista</th>
                        <th>Fecha de estreno</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($news as $new)
                        <tr>
                            <td class="align-top">{{ $new->news_id }}</td>
                            <td class="align-top">{{ $new->title }}</td>
                            <td class="align-top"><img src="{{ Storage::url($new->image) }}" class="card-img-top"
                                alt="{{ $new->title }}" class="img-fluid" 
                                style="width: 150px; height: 80px; object-fit: cover;"></td>
                                <td class="align-top">{{ $new->synopsis }}</td>
                                <td class="align-top">{{ $new->journalist }}</td>
                            <td class="align-top">{{ $new->release_date }}</td>
                            <td class="align-top">
                                <a href="{{ route('news.view', ['id' => $new->news_id]) }}" 
                                class="btn btn-primary">Ver</a>
                                @auth
                                    <a href="{{ route('news.edit.form', ['id' => $new->news_id]) }}" 
                                    class="btn btn-secondary ms-2">Editar</a>

                                    <form action="{{ route('news.delete.process', ['id' => $new->news_id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" onclick="return confirm('Está seguro de borrar la noticia?')"
                                            class="btn btn-danger ms-2" value="Eliminar">
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach

                    
                </thead>
            </table>
        </div>
    </div>
</div>



@endsection