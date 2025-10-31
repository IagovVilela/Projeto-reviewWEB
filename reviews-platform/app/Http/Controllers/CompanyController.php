<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ReviewPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $companies = Company::withCount(['reviews', 'reviewPages'])
            ->orderBy('status', 'asc') // Rascunhos primeiro
            ->orderBy('created_at', 'desc')
            ->get();
=======
        $user = auth()->user();
        
        // Admin e Proprietário vêem todas as empresas
        if (in_array($user->role, ['admin', 'proprietario'])) {
            $companies = Company::with('user')
                ->withCount(['reviews', 'reviewPages'])
                ->orderBy('status', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        } else {
            // User comum vê apenas suas empresas
            $companies = Company::where('user_id', $user->id)
                ->with('user')
                ->withCount(['reviews', 'reviewPages'])
                ->orderBy('status', 'asc')
                ->orderBy('created_at', 'desc')
                ->paginate(12);
        }
>>>>>>> Perfil-gerenciamento-usuarios
            
        return view('companies', compact('companies'));
    }

    public function create()
    {
        // Usuários agora podem criar quantas empresas quiserem
        return view('companies-create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        // Usuários agora podem criar quantas empresas/páginas de avaliação quiserem
        \Log::info('CompanyController@store chamado', ['request_data' => $request->all()]);
        
        // Determinar se é rascunho ou publicação
        $isDraft = $request->has('save_as_draft') && $request->save_as_draft === 'true';
        
        // Validação diferente para rascunho vs publicação
        if ($isDraft) {
            // Validação mais flexível para rascunho
            $request->validate([
                'name' => 'nullable|string|max:255',
                'url' => 'nullable|string|max:255',
                'negative_email' => 'nullable|email',
                'contact_number' => 'nullable|string|max:20',
                'business_website' => 'nullable|string|max:500',
                'business_address' => 'nullable|string|max:500',
                'google_business_url' => 'nullable|string|max:500',
                'positive_score' => 'nullable|integer|min:1|max:5',
                'logo' => 'nullable|file|max:2048',
                'background_image' => 'nullable|file|max:2048',
            ]);
        } else {
            // Validação completa para publicação
            $request->validate([
                'name' => 'required|string|max:255',
                'url' => 'nullable|string|max:255',
                'negative_email' => 'required|email',
                'contact_number' => 'nullable|string|max:20',
                'business_website' => 'nullable|string|max:500',
                'business_address' => 'nullable|string|max:500',
                'google_business_url' => 'nullable|string|max:500',
                'positive_score' => 'required|integer|min:1|max:5',
                'logo' => 'nullable|file|max:2048',
                'background_image' => 'nullable|file|max:2048',
            ]);
        }

        \Log::info('Validação passou com sucesso', ['is_draft' => $isDraft]);
        
        $data = $request->all();
        
        // Adicionar user_id automaticamente
        $data['user_id'] = $user->id;
        
        // Handle file uploads
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('backgrounds', 'public');
        }

        // Definir status
        $data['status'] = $isDraft ? 'draft' : 'published';

        // Create company
        \Log::info('Criando empresa', ['data' => $data]);
        $company = Company::create($data);
        \Log::info('Empresa criada', ['company_id' => $company->id, 'token' => $company->token, 'status' => $company->status]);

        if (!$isDraft) {
            // Create review page apenas para empresas publicadas
            \Log::info('Criando review page');
            $reviewPage = ReviewPage::create([
                'company_id' => $company->id,
                'token' => $company->token,
                'url' => $company->public_url,
            ]);
            \Log::info('Review page criada', ['review_page_id' => $reviewPage->id]);

            \Log::info('Redirecionando para página pública', ['token' => $company->token]);
            return redirect()->route('public.review-page', ['token' => $company->token])
                ->with('success', 'Empresa ativada com sucesso! Sua página pública está pronta!');
        } else {
            // Para rascunhos, redirecionar para página de edição
            \Log::info('Redirecionando para página de edição', ['company_id' => $company->id]);
            return redirect()->route('companies.edit', ['id' => $company->id])
                ->with('success', 'Empresa salva como rascunho! Você pode continuar editando e publicar quando estiver pronto.');
        }
    }

    public function show($token)
    {
        $company = Company::where('token', $token)->firstOrFail();
        $reviews = $company->reviews()->orderBy('created_at', 'desc')->get();
        
        return view('public.review-page', compact('company', 'token', 'reviews'));
    }

    public function edit($id)
    {
<<<<<<< HEAD
        $company = Company::findOrFail($id);
        
=======
        $user = auth()->user();
        $company = Company::findOrFail($id);
        
        // Verificar se o usuário tem permissão para editar
        if ($user->role === 'user' && $company->user_id !== $user->id) {
            return redirect()->route('companies.index')
                ->with('error', 'Você não tem permissão para editar esta empresa.');
        }
        
>>>>>>> Perfil-gerenciamento-usuarios
        // Verificar se a empresa já está ativa (publicada)
        if ($company->status === 'published') {
            return redirect()->route('companies.index')
                ->with('error', 'Esta empresa já está ativa e não pode ser editada. Apenas empresas em rascunho podem ser editadas.');
        }
        
        return view('companies-edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
<<<<<<< HEAD
=======
        $user = auth()->user();
>>>>>>> Perfil-gerenciamento-usuarios
        \Log::info('CompanyController@update chamado', ['company_id' => $id, 'request_data' => $request->all()]);
        
        $company = Company::findOrFail($id);
        
<<<<<<< HEAD
=======
        // Verificar se o usuário tem permissão para editar
        if ($user->role === 'user' && $company->user_id !== $user->id) {
            return redirect()->route('companies.index')
                ->with('error', 'Você não tem permissão para editar esta empresa.');
        }
        
>>>>>>> Perfil-gerenciamento-usuarios
        // Verificar se a empresa já está ativa (publicada) e não é um rascunho
        if ($company->status === 'published' && !$request->has('save_as_draft')) {
            return redirect()->route('companies.index')
                ->with('error', 'Esta empresa já está ativa e não pode ser editada. Apenas empresas em rascunho podem ser editadas.');
        }
        
        // Determinar se é rascunho ou publicação
        $isDraft = $request->has('save_as_draft') && $request->save_as_draft === 'true';
        
        // Validação diferente para rascunho vs publicação
        if ($isDraft) {
            // Validação mais flexível para rascunho
            $request->validate([
                'name' => 'nullable|string|max:255',
                'url' => 'nullable|string|max:255',
                'negative_email' => 'nullable|email',
                'contact_number' => 'nullable|string|max:20',
                'business_website' => 'nullable|string|max:500',
                'business_address' => 'nullable|string|max:500',
                'google_business_url' => 'nullable|string|max:500',
                'positive_score' => 'nullable|integer|min:1|max:5',
                'logo' => 'nullable|file|max:2048',
                'background_image' => 'nullable|file|max:2048',
            ]);
        } else {
            // Validação completa para publicação
            $request->validate([
                'name' => 'required|string|max:255',
                'url' => 'nullable|string|max:255',
                'negative_email' => 'required|email',
                'contact_number' => 'nullable|string|max:20',
                'business_website' => 'nullable|string|max:500',
                'business_address' => 'nullable|string|max:500',
                'google_business_url' => 'nullable|string|max:500',
                'positive_score' => 'required|integer|min:1|max:5',
                'logo' => 'nullable|file|max:2048',
                'background_image' => 'nullable|file|max:2048',
            ]);
        }

        \Log::info('Validação passou com sucesso', ['is_draft' => $isDraft]);
        
        $data = $request->all();
        
        // Handle file uploads
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('backgrounds', 'public');
        }

        // Definir status
        $data['status'] = $isDraft ? 'draft' : 'published';

        // Update company
        \Log::info('Atualizando empresa', ['data' => $data]);
        $company->update($data);
        \Log::info('Empresa atualizada', ['company_id' => $company->id, 'status' => $company->status]);

        if (!$isDraft && $company->status === 'published') {
            // Create review page se não existir
            if (!$company->reviewPages()->exists()) {
                \Log::info('Criando review page');
                $reviewPage = ReviewPage::create([
                    'company_id' => $company->id,
                    'token' => $company->token,
                    'url' => $company->public_url,
                ]);
                \Log::info('Review page criada', ['review_page_id' => $reviewPage->id]);
            }

            \Log::info('Redirecionando para página pública', ['token' => $company->token]);
            return redirect()->route('public.review-page', ['token' => $company->token])
                ->with('success', 'Empresa ativada com sucesso! Sua página pública está pronta!');
        } else {
            // Para rascunhos, redirecionar para página de edição
            \Log::info('Redirecionando para página de edição', ['company_id' => $company->id]);
            return redirect()->route('companies.edit', ['id' => $company->id])
                ->with('success', 'Empresa salva como rascunho! Você pode continuar editando e publicar quando estiver pronto.');
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $company = Company::findOrFail($id);
        
        // Verificar se o usuário tem permissão para excluir
        if ($user->role === 'user' && $company->user_id !== $user->id) {
            return redirect()->route('companies.index')
                ->with('error', 'Você não tem permissão para excluir esta empresa.');
        }
        
        $company->delete();
        
        return redirect()->route('companies.index')
            ->with('success', 'Empresa excluída com sucesso!');
    }
}
