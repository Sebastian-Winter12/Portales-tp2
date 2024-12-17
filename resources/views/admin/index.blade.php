@extends('layouts.main')

@section('title', 'Administrador')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <x-nav></x-nav>
            <h1 class="text-center mb-3">Vista de administrador</h1>

            {{-- Dashboard --}}
            <h3 class="text-center mb-4">Dashboard</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Juegos comprados y Ganancia generada
                        </div>
                        <div class="card-body">
                            <p><strong>Total de juegos vendidos: {{ $totalGamesSold }}</strong> </p>
                            <p><strong>Ganancia generada: ${{ $totalRevenue }}</strong> </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Usuarios registrados
                        </div>
                        <div class="card-body">
                            <p><strong>Total de usuarios: {{ $totalUsers }}</strong> </p>
                            <p><strong>Admins: {{ $totalAdmins }}</strong> </p>
                            <p><strong>Usuarios comunes: {{ $totalRegularUsers }}</strong> </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Usuarios --}}
            <h2 class="text-center mb-3 mt-5">Listado de usuarios</h2>
            <div class="mb-3 text-center">
                <a class="bg-primary text-white text-decoration-none px-3 py-2 border rounded" href="{{ route('register') }}"> Crear nuevo usuario</a>
            </div>

            <section class="mb-3 mt-4 d-flex justify-content-center align-items-center flex-column">
                <h3>Buscador</h2>
                <form action="{{ route('admin.index') }}" method="GET">
                    <div class="d-flex gap-3 align-items-end mb-3">
                        <div class="">
                            <input type="search" name="s-name" id="s-name" class="form-control" value="{{ $searchParams['s-name'] }}" placeholder="Título">
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </section>
            @if (!empty($searchParams['s-name']))
                <p class="mb-3 fst-italic">
                    Mostrando los resultados de la búsqueda para el término: <strong>{{ $searchParams['s-name'] }}</strong>
                </p>
            @endif

            @if ($games->isNotEmpty())
                <table class="table table-bordered table-striped">
                </table>
            @else
            <p>No se encontraron resultados con los criterios de busqueda ingresados</p>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="align-top">{{ $user->id }}</td>
                            <td class="align-top">{{ $user->name }}</td>
                            <td class="align-top">{{ $user->email }}</td>
                            <td class="align-top">******</td>
                            <td class="align-top">
                                <a href="{{ route('users.view', ['id' => $user->id]) }}"
                                   class="btn btn-primary">Ver</a>
                                @auth
                                    <a href="{{ route('users.edit-form', ['id' => $user->id]) }}"
                                       class="btn btn-secondary ms-2">Editar</a>

                                    <form action="{{ route('users.delete.process', ['id' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" onclick="return confirm('Está seguro de borrar este usuario?')"
                                               class="btn btn-danger ms-2" value="Eliminar">
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Videojuegos --}}
            <h2 class="text-center mb-3 mt-5">Listado de videojuegos</h2>
            <div class="mb-3 text-center">
                <a class="bg-primary text-white text-decoration-none px-3 py-2 border rounded " href="{{ route('games.create.form') }}"> Publicar un nuevo juego </a>
            </div>

            <section class="mb-3 mt-4 d-flex justify-content-center align-items-center flex-column">
                <h3>Buscador</h2>
                    <form id="search-form">
                        <div class="d-flex gap-3 align-items-end mb-3">
                            <div>
                                <input type="search" name="s-title" id="s-title" class="form-control" value="{{ $searchParams['s-title'] }}" placeholder="Título">
                            </div>
                            <div>
                                <label for="s-age" class="form-label">Clasificación</label>
                                <select name="s-age" id="s-age" class="form-control">
                                    <option value="">Todas las clasificaciones</option>
                                    @foreach ($age as $age)
                                        <option value="{{ $age->age_id }}" @selected($age->age_id == $searchParams['s-age'])>
                                            {{ $age->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>

            </section>
            @if (!empty($searchParams['s-title']))
                <p class="mb-3 fst-italic">
                    Mostrando los resultados de la búsqueda para el término: <strong>{{ $searchParams['s-title'] }}</strong>
                </p>
            @endif

            @if ($games->isNotEmpty())
                <table class="table table-bordered table-striped">
                </table>
                {{ $games->links() }}
            @else
            <p>No se encontraron resultados con los criterios de busqueda ingresados</p>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Fecha de estreno</th>
                        <th>Precio</th>
                        <th>Sinopsis</th>
                        <th>Modo de juego</th>
                        <th>Clasificación</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach ($games as $game)
                        <tr>
                            <td class="align-top">{{ $game->id }}</td>
                            @if ($game->image)
                                <td class="align-top"><img src="{{ Storage::url($game->image) }}" class="card-img-top"
                                alt="{{ $game->title }}" class="img-fluid"
                                style="width: 150px; height: 80px; object-fit: cover;"></td>
                                @else
                                <p>No hay portada</p>
                            @endif

                            <td class="align-top">{{ $game->title }}</td>
                            <td class="align-top">{{ $game->release_date }}</td>
                            <td class="align-top">{{ $game->price }}</td>
                            <td class="align-top">{{ $game->synopsis }}</td>
                            <td class="align-top">{{ $game->game_type }}</td>
                            <td>{{ $game->age->name }}</td>
                            <td class="align-top">
                                <a href="{{ route('games.view', ['id' => $game->id]) }}"
                                class="btn btn-primary">Ver</a>
                                @auth
                                    <a href="{{ route('games.edit.form', ['id' => $game->id]) }}"
                                    class="btn btn-secondary ms-2">Editar</a>

                                    <form action="{{ route('games.delete.process', ['id' => $game->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" onclick="return confirm('Está seguro de borrar el videojuego?')"
                                            class="btn btn-danger ms-2" value="Eliminar">
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </thead>
            </table>

            {{-- Noticias --}}
            <h2 class="text-center mb-3 mt-5">Nuestras noticias</h2>
            <div class="mb-3 text-center">
                <a class="bg-primary text-white text-decoration-none px-3 py-2 border rounded " href="{{ route('news.create.form') }}"> Publicar una nueva nota </a>
            </div>

            <section class="mb-3 mt-4 d-flex justify-content-center align-items-center flex-column">
                <h3>Buscador</h2>
                <form action="{{ route('admin.index') }}" method="GET">
                    <div class="d-flex gap-3 align-items-end mb-3">
                        <div class="">
                            <input type="search" name="s-news" id="s-news" class="form-control" value="{{ $searchParams['s-news'] }}" placeholder="Título">
                        </div>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </section>
            @if (!empty($searchParams['s-news']))
                <p class="mb-3 fst-italic">
                    Mostrando los resultados de la búsqueda para el término: <strong>{{ $searchParams['s-news'] }}</strong>
                </p>
            @endif

            @if ($games->isNotEmpty())
                <table class="table table-bordered table-striped">
                </table>
            @else
            <p>No se encontraron resultados con los criterios de busqueda ingresados</p>
            @endif

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
