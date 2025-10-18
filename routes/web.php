<?php

use Illuminate\Support\Facades\Route;

// Rota principal - serve a aplicação React
Route::get('/', function () {
    return view('app');
});

// Rota para páginas públicas de avaliação
Route::get('/r/{token}', function () {
    return view('app');
});

// Rota catch-all para SPA (Single Page Application)
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');