@extends('layouts.main')

@section('title', 'autenticacion')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-3">Crear mi cuenta</h1>
                <form action="{{ route('auth.create.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="text" class="form-label">Nombre</label>
                        <input type="name" id="name" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
            </div>
        </div>
    </div>

@endsection