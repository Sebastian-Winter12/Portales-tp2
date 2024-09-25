<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, "home"]);

Route::get('/acerca-de', [\App\Http\Controllers\HomeController::class, "about"]);

Route::get('/contacto', [\App\Http\Controllers\HomeController::class, "contact"]);
