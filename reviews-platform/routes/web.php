<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', function () {
    return view('app');
});

// Change locale route
Route::post('/change-locale', function (Request $request) {
    $locale = $request->input('locale', 'pt_BR');
    
    if (in_array($locale, ['pt_BR', 'en_US'])) {
        session(['locale' => $locale]);
        return response()->json(['success' => true, 'locale' => $locale]);
    }
    
    return response()->json(['success' => false], 400);
})->name('change-locale');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Create admin user (for initial setup)
Route::get('/create-admin', [AuthController::class, 'createAdmin']);

// Protected admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        // Contar avaliações negativas não processadas
        $negativeCount = \App\Models\Review::where('is_positive', false)
            ->where(function($query) {
                $query->where('is_processed', false)
                      ->orWhereNull('is_processed');
            })
            ->count();
        
        return view('dashboard', compact('negativeCount'));
    });
    
    Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{id}/edit', [App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
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