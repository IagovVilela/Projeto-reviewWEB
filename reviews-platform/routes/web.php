<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', function () {
    return view('app');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Create admin user (for initial setup)
Route::get('/create-admin', [AuthController::class, 'createAdmin']);

// Protected admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    Route::delete('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');

    // Admin Reviews Routes
    Route::get('/reviews', function () {
        return view('admin.reviews.index');
    })->name('reviews.index');
    Route::get('/reviews/negative', function () {
        return view('admin.reviews.negative');
    })->name('reviews.negative');
});

// Public review page (no auth required)
Route::get('/r/{token}', [App\Http\Controllers\CompanyController::class, 'show'])->name('public.review-page');

// API Routes
Route::post('/api/reviews', [App\Http\Controllers\ReviewController::class, 'store']);

// Rota catch-all para SPA (Single Page Application) - APENAS para rotas que não começam com 'api'
Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!api).*');