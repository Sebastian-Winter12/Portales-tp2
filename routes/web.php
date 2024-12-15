<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

app()->singleton('role.middleware', function () {
    return new RoleMiddleware();
});

//home

Route::get('/', [\App\Http\Controllers\GamesController::class, "home"])
    ->name('home');

//noticias

Route::get('/noticias', [\App\Http\Controllers\NewsController::class, "news"])
    ->name('news.news');

Route::get('noticias/{id}', [App\Http\Controllers\NewsController::class, "view"])
    ->name('news.view')
    ->whereNumber('id');

Route::get('noticias/publicar', [App\Http\Controllers\NewsController::class, "createForm"])
    ->name('news.create.form')
    ->middleware('auth');

Route::get('noticias/{id}/editar', [App\Http\Controllers\NewsController::class, "editForm"])
    ->name('news.edit.form')
    ->whereNumber('id')
    ->middleware('auth');

Route::put('noticias/{id}/editar', [App\Http\Controllers\NewsController::class, "editProcess"])
    ->name('news.edit.process')
    ->whereNumber('id')
    ->middleware('auth');

Route::delete('noticias/{id}/eliminar', [App\Http\Controllers\NewsController::class, "deleteProcess"])
    ->name('news.delete.process')
    ->whereNumber('id')
    ->middleware('auth');

Route::post('noticias/publicar', [App\Http\Controllers\NewsController::class, "createProcess"])
    ->name('news.create.process')
    ->middleware('auth');

// videojuegos

Route::get('videojuegos/listado', [App\Http\Controllers\GamesController::class, "index"])
    ->name('games.index');

Route::get('videojuegos/{id}', [App\Http\Controllers\GamesController::class, "view"])
    ->name('games.view')
    ->whereNumber('id');

Route::get('videojuegos/publicar', [App\Http\Controllers\GamesController::class, "createForm"])
    ->name('games.create.form')
    ->middleware('auth');

Route::get('videojuegos/{id}/editar', [App\Http\Controllers\GamesController::class, "editForm"])
    ->name('games.edit.form')
    ->whereNumber('id')
    ->middleware('auth');

Route::put('videojuegos/{id}/editar', [App\Http\Controllers\GamesController::class, "editProcess"])
    ->name('games.edit.process')
    ->whereNumber('id')
    ->middleware('auth');

Route::delete('videojuegos/{id}/eliminar', [App\Http\Controllers\GamesController::class, "deleteProcess"])
    ->name('games.delete.process')
    ->whereNumber('id')
    ->middleware('auth');

Route::post('videojuegos/publicar', [App\Http\Controllers\GamesController::class, "createProcess"])
    ->name('games.create.process')
    ->middleware('auth');

//Usuarios

Route::get('usuarios/listado', [App\Http\Controllers\UsersController::class, "index"])
    ->name('users.index');

Route::get('usuarios/{id}', [App\Http\Controllers\UsersController::class, "view"])
    ->name('users.view')
    ->whereNumber('id');

Route::get('usuarios/{id}/editar', [App\Http\Controllers\UsersController::class, "editForm"])
    ->name('users.edit.form')
    ->whereNumber('id')
    ->middleware('auth');

Route::put('usuarios/{id}/editar', [App\Http\Controllers\UsersController::class, "editProcess"])
    ->name('users.edit.process')
    ->whereNumber('id')
    ->middleware('auth');

Route::delete('usuarios/{id}/eliminar', [App\Http\Controllers\UsersController::class, "deleteProcess"])
    ->name('users.delete.process')
    ->whereNumber('id')
    ->middleware('auth');

// Ruta a modificar

Route::get('/perfil/{id}', [App\Http\Controllers\UsersController::class, "profile"])
    ->name('user.profile')
    ->whereNumber('id');

// La ruta de arriba es la que hay que modificar

// Autenticacion

Route::get('/iniciar-sesion', [App\Http\Controllers\AuthController::class, "loginForm"])
    ->name('login');

Route::post('/iniciar-sesion', [App\Http\Controllers\AuthController::class, "loginProcess"])
    ->name('auth.login.process');

Route::get('/crear-cuenta', [App\Http\Controllers\UsersController::class, 'registerForm'])
    ->name('register');

Route::post('/crear-cuenta', [App\Http\Controllers\UsersController::class, 'registerProcess'])
    ->name('auth.register.process');

Route::post('/cerrar-sesion', [App\Http\Controllers\AuthController::class, "logoutProcess"])
    ->name('auth.logout.process');


//Envio de correos

Route::post('/videojuegos/{id}/reservar', [App\Http\Controllers\GamesReservationController::class, "reservationProcess"])
    ->name('games.reservation.process');

Route::get('/test/emails/reservar-videojuegos', [App\Http\Controllers\GamesReservationController::class, "printEmail"])
    ->name('games.reservation.test');
