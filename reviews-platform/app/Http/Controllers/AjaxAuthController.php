<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Review;

class AjaxAuthController extends Controller
{
    /**
     * Retorna todas as empresas para o usuário atual
     */
    public function getCompanies(Request $request)
    {
        try {
            $user = auth()->user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Não autenticado'
                ], 401);
            }
            
            if ($user->role === 'admin') {
                // Admin vê todas empresas
                $companies = Company::select('id', 'name', 'token')->get();
            } else {
                // Usuários normais vêem apenas suas empresas
                $companies = Company::select('id', 'name', 'token')
                    ->where('user_id', $user->id)
                    ->get();
            }
            
            return response()->json([
                'success' => true,
                'data' => $companies
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar empresas: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Retorna todas as avaliações para o usuário atual
     */
    public function getReviews(Request $request)
    {
        return app('App\Http\Controllers\ReviewController')->index($request);
    }
    
    /**
     * Retorna avaliações negativas para o usuário atual
     */
    public function getNegativeReviews(Request $request)
    {
        return app('App\Http\Controllers\ReviewController')->negativeReviews($request);
    }
    
    /**
     * Exporta contatos de uma empresa
     */
    public function exportContacts(Request $request, $companyId)
    {
        return app('App\Http\Controllers\ReviewController')->exportContacts($request, $companyId);
    }
}
