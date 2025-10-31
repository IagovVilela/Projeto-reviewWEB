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
            
            if (in_array($user->role, ['admin', 'proprietario'])) {
                // Admin e Proprietário vêem todas empresas com informações do usuário
                $companies = Company::with('user:id,name,email')
                    ->select('id', 'name', 'token', 'user_id')
                    ->get()
                    ->map(function ($company) {
                        return [
                            'id' => $company->id,
                            'name' => $company->name,
                            'token' => $company->token,
                            'user_id' => $company->user_id,
                            'user_name' => $company->user ? $company->user->name : null,
                            'user_email' => $company->user ? $company->user->email : null
                        ];
                    });
            } else {
                // Usuários normais vêem apenas suas empresas
                $companies = Company::select('id', 'name', 'token', 'user_id')
                    ->where('user_id', $user->id)
                    ->get()
                    ->map(function ($company) {
                        return [
                            'id' => $company->id,
                            'name' => $company->name,
                            'token' => $company->token,
                            'user_id' => $company->user_id,
                            'user_name' => $user->name,
                            'user_email' => $user->email
                        ];
                    });
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
    
    /**
     * Retorna lista de usuários com empresas (para filtro)
     */
    public function getUsersWithCompanies(Request $request)
    {
        try {
            $user = auth()->user();
            
            if (!$user || !in_array($user->role, ['admin', 'proprietario'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Acesso negado'
                ], 403);
            }
            
            $users = \App\Models\User::withCount('companies')
                ->has('companies')
                ->select('id', 'name', 'email')
                ->orderBy('name')
                ->get()
                ->map(function ($u) {
                    return [
                        'id' => $u->id,
                        'name' => $u->name,
                        'email' => $u->email,
                        'companies_count' => $u->companies_count
                    ];
                });
            
            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar usuários: ' . $e->getMessage()
            ], 500);
        }
    }
}
