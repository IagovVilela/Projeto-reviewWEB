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

Route::get('/companies', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies', [App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
Route::delete('/companies/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');

// Rota para páginas públicas de avaliação
Route::get('/r/{token}', [App\Http\Controllers\CompanyController::class, 'show'])->name('public.review-page');

// API Routes
Route::post('/api/reviews', function (Illuminate\Http\Request $request) {
    // Simular salvamento da avaliação (em produção, salvar no banco)
    $review = [
        'id' => uniqid(),
        'company_token' => $request->company_token,
        'rating' => $request->rating,
        'whatsapp' => $request->whatsapp,
        'comment' => $request->comment,
        'created_at' => now(),
        'is_positive' => $request->rating >= 4
    ];
    
    // Simular envio de email (em produção, implementar sistema real)
    $emailData = [
        'company_name' => 'Restaurante XYZ', // Buscar do banco
        'rating' => $request->rating,
        'whatsapp' => $request->whatsapp,
        'comment' => $request->comment,
        'is_positive' => $review['is_positive']
    ];
    
    // Log para debug (em produção, enviar email real)
    \Log::info('Nova avaliação recebida:', $review);
    
    return response()->json([
        'success' => true,
        'message' => 'Avaliação enviada com sucesso!',
        'review' => $review
    ]);
});

// Rota catch-all para SPA (Single Page Application)
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');