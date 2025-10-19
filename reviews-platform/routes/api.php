<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Review API Routes
Route::post('/reviews', [ReviewController::class, 'store']);
Route::post('/reviews/private-feedback', [ReviewController::class, 'storePrivateFeedback']);
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/negative', [ReviewController::class, 'negativeReviews']);
Route::get('/companies/{companyId}/contacts', [ReviewController::class, 'exportContacts']);

// Company API Routes
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