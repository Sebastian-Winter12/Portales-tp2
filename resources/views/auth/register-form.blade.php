@extends('layouts.main')

@section('title', 'Crear cuenta')

@section('content')

    <div class="container">
        <div class="row">
            <div class="mt-3 mb-3">
                <a href="{{ route('home') }}" class="btn btn-secondary">Volver a Inicio</a>
            </div>
            <div class="col-12">
                <h1 class="mb-3">Crear mi cuenta</h1>
                <form action="{{ route('auth.register.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="text" class="form-label">Nombre</label>
                        <input type="name" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Crear cuenta</button>
                </form>
            </div>
        </div>
    </div>

@endsection
