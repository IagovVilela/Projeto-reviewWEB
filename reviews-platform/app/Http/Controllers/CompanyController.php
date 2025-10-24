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
        $companies = Company::withCount(['reviews', 'reviewPages'])
            ->orderBy('created_at', 'desc')
            ->paginate(12); // 12 empresas por página
            
        return view('companies', compact('companies'));
    }

    public function create()
    {
        return view('companies-create');
    }

    public function store(Request $request)
    {
        \Log::info('CompanyController@store chamado', ['request_data' => $request->all()]);
        
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

        \Log::info('Validação passou com sucesso');
        
        $data = $request->all();
        
        // Handle file uploads
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('backgrounds', 'public');
        }

        // Create company
        \Log::info('Criando empresa', ['data' => $data]);
        $company = Company::create($data);
        \Log::info('Empresa criada', ['company_id' => $company->id, 'token' => $company->token]);

        // Create review page
        \Log::info('Criando review page');
        $reviewPage = ReviewPage::create([
            'company_id' => $company->id,
            'token' => $company->token,
            'url' => $company->public_url,
        ]);
        \Log::info('Review page criada', ['review_page_id' => $reviewPage->id]);

        \Log::info('Redirecionando para página pública', ['token' => $company->token]);
        return redirect()->route('public.review-page', ['token' => $company->token])
            ->with('success', 'Empresa criada com sucesso! Sua página pública está pronta!');
    }

    public function show($token)
    {
        $company = Company::where('token', $token)->firstOrFail();
        $reviews = $company->reviews()->orderBy('created_at', 'desc')->get();
        
        return view('public.review-page', compact('company', 'token', 'reviews'));
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        
        return redirect()->route('companies.index')
            ->with('success', 'Empresa excluída com sucesso!');
    }
}
