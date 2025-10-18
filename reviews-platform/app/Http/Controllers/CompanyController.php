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
            ->get();
            
        return view('companies', compact('companies'));
    }

    public function create()
    {
        return view('companies-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'negative_email' => 'required|email',
            'contact_number' => 'nullable|string|max:20',
            'business_website' => 'nullable|url',
            'business_address' => 'nullable|string|max:500',
            'google_business_url' => 'nullable|url',
            'positive_score' => 'required|integer|min:1|max:5',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle file uploads
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('backgrounds', 'public');
        }

        // Create company
        $company = Company::create($data);

        // Create review page
        $reviewPage = ReviewPage::create([
            'company_id' => $company->id,
            'token' => $company->token,
            'url' => $company->public_url,
        ]);

        return redirect()->route('companies.index')
            ->with('success', 'Empresa criada com sucesso!')
            ->with('company_url', $company->public_url);
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
