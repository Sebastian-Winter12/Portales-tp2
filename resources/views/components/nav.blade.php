<div>
    <div class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <x-nav-link route="home">Home</x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link route="news.news">Noticias</x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link route="games.index">Videojuegos</x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link route="users.index">Usuarios</x-nav-link>
                    </li>

                    <li class="nav-item">
                        <x-nav-link :route="route('profile.profile', ['id' => $user->id])">Perfil</x-nav-link>
                    </li>                    

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <form action="{{ route('auth.logout.process') }}" method="POST">
                                @csrf
                                <button class="nav-link">{{ auth()->user()->email }} (Cerrar sesión)</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</div>
