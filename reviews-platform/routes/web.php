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

// Dashboard route - accessible to all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            // Dashboard de administrador
            $negativeCount = \App\Models\Review::where('is_positive', false)
                ->where(function($query) {
                    $query->where('is_processed', false)
                          ->orWhereNull('is_processed');
                })
                ->count();
            
            return view('dashboard', compact('negativeCount'));
        } else {
            // Dashboard de usuário comum
            $company = $user->companies()->first();
            $hasCompany = $company !== null;
            
            $stats = [
                'total_reviews' => $hasCompany ? $company->reviews()->count() : 0,
                'positive_reviews' => $hasCompany ? $company->reviews()->where('is_positive', true)->count() : 0,
                'negative_reviews' => $hasCompany ? $company->reviews()->where('is_positive', false)->count() : 0,
                'average_rating' => $hasCompany ? round($company->reviews()->avg('rating'), 1) : 0,
            ];
            
            return view('dashboard-user', compact('company', 'hasCompany', 'stats'));
        }
    })->name('dashboard');
});

// Companies routes - accessible to all authenticated users (with controller-level restrictions)
Route::middleware(['auth'])->group(function () {
    Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/{id}/edit', [App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
});

// Protected admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Reviews Routes
    Route::get('/reviews', function () {
        return view('admin.reviews.index');
    })->name('reviews.index');
    Route::get('/reviews/negative', function () {
        return view('admin.reviews.negative');
    })->name('reviews.negative');

    // API Routes for Admin Panel (with auth and session)
    Route::prefix('api')->group(function () {
        Route::get('/reviews', [App\Http\Controllers\ReviewController::class, 'index']);
        Route::get('/reviews/negative', [App\Http\Controllers\ReviewController::class, 'negativeReviews']);
        Route::get('/companies/{companyId}/contacts', [App\Http\Controllers\ReviewController::class, 'exportContacts']);
        
        Route::get('/companies', function () {
            try {
                $companies = \App\Models\Company::select('id', 'name', 'token')->get();
                return response()->json([
                    'success' => true,
                    'data' => $companies
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao carregar empresas'
                ], 500);
            }
        });
    });

    // User Management Routes (Admin Only)
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
});

// Profile Routes (All authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/photo', [App\Http\Controllers\ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
});

// Public review page (no auth required)
Route::get('/r/{token}', [App\Http\Controllers\CompanyController::class, 'show'])->name('public.review-page');

// API Routes
Route::post('/api/reviews', [App\Http\Controllers\ReviewController::class, 'store']);

// Rota catch-all para SPA (Single Page Application) - APENAS para rotas que não começam com 'api'
Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!api).*');