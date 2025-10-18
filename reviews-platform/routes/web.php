<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Rota para páginas públicas de avaliação
Route::get('/r/{token}', function () {
    return view('app');
});

// Rota catch-all para SPA (Single Page Application)
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');