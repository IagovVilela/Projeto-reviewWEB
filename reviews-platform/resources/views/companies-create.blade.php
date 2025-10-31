@extends('layouts.admin')

@section('title', __('companies.create') . ' - Reviews Platform')

@section('page-title', __('companies.create_company'))
@section('page-description', __('companies.create_company_desc'))

@section('header-actions')
    <a href="/companies" class="text-gray-600 hover:text-gray-800 transition-colors mr-4">
        <i class="fas fa-arrow-left mr-2"></i>
        {{ __('companies.back') }}
    </a>
    <button type="button" onclick="document.getElementById('companyForm').submit()" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-save mr-2"></i>
        {{ __('companies.save_company') }}
    </button>
@endsection

@section('styles')
    <style>
        .upload-area {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }
        
        .upload-area:hover {
            border-color: var(--primary-color);
            background-color: rgba(139, 92, 246, 0.05);
        }
        
        .upload-area.dragover {
            border-color: var(--primary-color);
            background-color: rgba(139, 92, 246, 0.1);
        }
        
        .slider {
            -webkit-appearance: none;
            appearance: none;
            background: #e5e7eb;
            outline: none;
            border-radius: 8px;
            height: 8px;
        }
        
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            background: var(--primary-color);
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(139, 92, 246, 0.3);
            transition: all 0.3s ease;
        }
        
        .slider::-webkit-slider-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
        }
        
        .slider::-moz-range-thumb {
            width: 20px;
            height: 20px;
            background: var(--primary-color);
            border-radius: 50%;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 6px rgba(139, 92, 246, 0.3);
            transition: all 0.3s ease;
        }
        
        .slider::-moz-range-thumb:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
        }
        
        .form-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Progress Indicator -->
        <div class="mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('companies.progress') }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400" id="progressText" data-fields-text="{{ __('companies.fields_completed') }}">0/7 {{ __('companies.fields_completed') }}</span>
            </div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                <div id="progressBar" class="h-2 rounded-full transition-all duration-300 bg-purple-600" style="width: 0%;"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data" id="companyForm" class="space-y-6">
            @csrf
            
            <!-- Informações Básicas -->
            <div class="form-section p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-building text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ __('companies.basic_info') }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('companies.basic_info_desc') }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Nome da Empresa -->
                    <div class="lg:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.name') }} *
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name"
                            required
                            class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="{{ __('companies.name_placeholder') }}"
                        >
                    </div>
                    
                    <!-- URL -->
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.url') }} *
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 border border-r-0 border-gray-300 dark:border-gray-600 rounded-l-lg">
                                rateus.io/
                            </span>
                            <input 
                                type="text" 
                                id="url" 
                                name="url"
                                required
                                class="flex-1 px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-r-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="{{ __('companies.url_placeholder') }}"
                            >
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            {{ __('companies.url_hint') }}
                        </p>
                    </div>
                    
                    <!-- Email para Feedback Negativo -->
                    <div>
                        <label for="negative_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.email') }} *
                        </label>
                        <input 
                            type="email" 
                            id="negative_email" 
                            name="negative_email"
                            required
                            class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="{{ __('companies.email_required') }}"
                        >
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            {{ __('companies.negative_email_desc') }}
                        </p>
                    </div>
                    
                    <!-- Pontuação Positiva -->
                    <div class="lg:col-span-2">
                        <label for="positive_score" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.positive_score_label') }}
                        </label>
                        <div class="flex items-center space-x-4">
                            <input 
                                type="range" 
                                id="positive_score" 
                                name="positive_score"
                                min="1" 
                                max="5" 
                                value="4"
                                class="flex-1 slider"
                                oninput="updateStarDisplay(this.value)"
                            >
                            <div class="flex items-center space-x-2 min-w-[120px]">
                                <span id="starCount" class="text-2xl font-bold text-purple-600 dark:text-purple-400">4</span>
                                <div class="flex text-yellow-400" id="starIcons">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            {{ __('companies.positive_score_desc') }}
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Detalhes da Empresa -->
            <div class="form-section p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
<<<<<<< HEAD
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="submitForm()" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-upload mr-2"></i>
                            ATIVAR
                        </button>
                        <button type="button" onclick="saveForm()" class="btn-secondary text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-save mr-2"></i>
                            SALVAR
                        </button>
=======
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ __('companies.company_details') }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('companies.company_details_desc') }}</p>
>>>>>>> Perfil-gerenciamento-usuarios
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Website -->
                    <div>
                        <label for="business_website" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.website') }}
                        </label>
                        <input 
                            type="url" 
                            id="business_website" 
                            name="business_website"
                            class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="{{ __('companies.website_placeholder') }}"
                        >
                    </div>
                    
                    <!-- Telefone -->
                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.phone') }}
                        </label>
                        <input 
                            type="tel" 
                            id="contact_number" 
                            name="contact_number"
                            class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="{{ __('companies.phone_placeholder') }}"
                        >
                    </div>
                    
                    <!-- Endereço -->
                    <div class="lg:col-span-2">
                        <label for="business_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.address') }}
                        </label>
                        <textarea 
                            id="business_address" 
                            name="business_address"
                            rows="3"
                            class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                            placeholder="{{ __('companies.address_placeholder') }}"
                        ></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Google My Business -->
            <div class="form-section p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                        <i class="fab fa-google text-white"></i>
                    </div>
<<<<<<< HEAD
                    
                    <!-- Form Sections -->
                    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data" id="companyForm">
                        @csrf
                        <div class="space-y-8">
                        <!-- CREATE BUSINESS Section -->
                        <div class="form-section p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">CRIAR EMPRESA</h2>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Left Column -->
                                <div class="space-y-6">
                                    <!-- Business Name -->
                                    <div>
                                        <label for="businessName" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nome da Empresa
                                        </label>
                                        <input 
                                            type="text" 
                                            id="businessName" 
                                            name="name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="Digite o nome da sua empresa"
                                            required
                                        >
                                    </div>
                                    
                                    <!-- URL -->
                                    <div>
                                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">
                                            URL
                                        </label>
                                        <div class="flex">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-500 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg">
                                                rateus.io/
                                            </span>
                                            <input 
                                                type="text" 
                                                id="url" 
                                                name="url"
                                                class="flex-1 px-3 py-2 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                                placeholder="sua-empresa"
                                            >
                                        </div>
                                        <a href="#" class="help-link mt-1">(O que isso significa?)</a>
                                    </div>
                                    
                                    <!-- Email for Negative Feedback -->
                                    <div>
                                        <label for="negativeEmail" class="block text-sm font-medium text-gray-700 mb-2">
                                            Para onde devemos enviar feedback negativo?
                                        </label>
                                        <input 
                                            type="email" 
                                            id="negativeEmail" 
                                            name="negative_email"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="contato@empresa.com"
                                            required
                                        >
                                        <a href="#" class="help-link mt-1">(O que isso significa?)</a>
                                    </div>
                                </div>
                                
                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <!-- Positive Score -->
                                    <div>
                                        <label for="positiveScore" class="block text-sm font-medium text-gray-700 mb-2">
                                            Pontuação Positiva
                                        </label>
                                        <div class="flex items-center space-x-4">
                                            <input 
                                                type="range" 
                                                id="positiveScore" 
                                                name="positive_score"
                                                min="1" 
                                                max="5" 
                                                value="4"
                                                class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider"
                                                oninput="updateStarDisplay(this.value)"
                                                required
                                            >
                                            <div class="flex items-center space-x-1">
                                                <span id="starCount" class="text-sm font-medium text-gray-700">4</span>
                                                <span class="text-sm text-gray-500">Estrelas</span>
                                            </div>
                                        </div>
                                        <a href="#" class="help-link mt-1">(O que isso significa?)</a>
                                    </div>
                                    
                                    <!-- Prize Draw -->
                                    <div>
                                        <div class="flex items-center space-x-3">
                                            <input 
                                                type="checkbox" 
                                                id="prizeDraw" 
                                                name="prizeDraw"
                                                class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500"
                                            >
                                            <label for="prizeDraw" class="text-sm font-medium text-gray-700">
                                                Incluir cliente em nosso sorteio de prêmios?
                                            </label>
                                        </div>
                                        <a href="#" class="help-link mt-1">(O que isso significa?)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Business Details Section -->
                        <div class="form-section p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Detalhes do Negócio</h2>
                            <p class="text-sm text-gray-600 mb-6">
                                Esses detalhes nos ajudam a localizar e vincular suas plataformas de avaliação escolhidas.
                            </p>
                            
                            <div class="space-y-6">
                                <!-- Active Business Website -->
                                <div>
                                    <label for="businessWebsite" class="block text-sm font-medium text-gray-700 mb-2">
                                        Site Ativo do Negócio
                                    </label>
                                    <input 
                                        type="url" 
                                        id="businessWebsite" 
                                        name="business_website"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                        placeholder="https://www.suaempresa.com"
                                    >
                                </div>
                                
                                    <!-- Contact Number -->
                                    <div>
                                        <label for="contactNumber" class="block text-sm font-medium text-gray-700 mb-2">
                                            Número de Contato
                                            <a href="#" class="help-link ml-1">(Por que precisamos disso?)</a>
                                        </label>
                                        <input 
                                            type="tel" 
                                            id="contactNumber" 
                                            name="contact_number"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="(11) 99999-9999"
                                            maxlength="15"
                                            oninput="formatPhoneNumber(this)"
                                        >
                                    </div>
                                
                                <!-- Business Address -->
                                <div>
                                    <label for="businessAddress" class="block text-sm font-medium text-gray-700 mb-2">
                                        Endereço do Negócio
                                    </label>
                                    <textarea 
                                        id="businessAddress" 
                                        name="business_address"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                                        placeholder="Rua, número, bairro, cidade, estado, CEP"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Google Reviews Configuration -->
                        <div class="form-section p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Configuração do Google Reviews</h2>
                            <p class="text-sm text-gray-600 mb-6">
                                Configure as avaliações do Google para seu estabelecimento. Todas as avaliações serão direcionadas para o Google My Business.
                            </p>
                            
                            <!-- Google Platform Card -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-6 mb-6">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center shadow-lg">
                                        <img src="/assets/images/platforms/google.png" alt="Google" class="w-12 h-12 object-contain">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-800">Google My Business</h3>
                                        <p class="text-gray-600">Plataforma oficial de avaliações do Google</p>
                                        <div class="flex items-center mt-2">
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                                ✓ Ativo
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Google Business URL -->
                            <div class="mb-6">
                                <label for="googleBusinessUrl" class="block text-sm font-medium text-gray-700 mb-2">
                                    URL do Google My Business
                                </label>
                                <input 
                                    type="url" 
                                    id="googleBusinessUrl" 
                                    name="google_business_url"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    placeholder="https://g.page/sua-empresa"
                                >
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Cole aqui o link direto para sua página do Google My Business
                                </p>
                            </div>
                        </div>
                        
                        <!-- Personalise your review page Section -->
                        <div class="form-section p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Personalizar sua página de avaliação</h2>
                            <p class="text-sm text-gray-600 mb-6">
                                Nota: você pode pular esta etapa e voltar a ela mais tarde
                            </p>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Logo Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Logo da Empresa
                                    </label>
                                    <div class="upload-area rounded-lg p-8 text-center cursor-pointer" onclick="document.getElementById('logoFile').click()">
                                        <div id="logoPreview" class="hidden mb-4 preview-container">
                                            <img id="logoPreviewImg" src="" alt="Preview" class="w-20 h-20 object-contain mx-auto rounded-lg border-2 border-gray-200">
                                            <button type="button" onclick="removeLogo()" class="remove-btn mt-2 text-red-500 hover:text-red-700 text-sm px-3 py-1 rounded-full border border-red-200 hover:border-red-300 hover:bg-red-50">
                                                <i class="fas fa-trash mr-1"></i> Remover Logo
                                            </button>
                                        </div>
                                        <div id="logoPlaceholder">
                                            <i class="fas fa-image text-4xl text-gray-400 mb-4"></i>
                                            <p class="text-sm text-gray-600 mb-2">Clique para fazer upload do logo</p>
                                            <p class="text-xs text-gray-500">PNG, JPG até 2MB</p>
                                        </div>
                                        <input type="file" id="logoFile" name="logo" accept="image/*" class="hidden">
                                    </div>
                                </div>
                                
                                <!-- Background Image Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Imagem de Fundo
                                    </label>
                                    <div class="upload-area rounded-lg p-8 text-center cursor-pointer" onclick="document.getElementById('bgFile').click()">
                                        <div id="bgPreview" class="hidden mb-4 preview-container">
                                            <img id="bgPreviewImg" src="" alt="Preview" class="w-20 h-20 object-cover mx-auto rounded-lg border-2 border-gray-200">
                                            <button type="button" onclick="removeBackground()" class="remove-btn mt-2 text-red-500 hover:text-red-700 text-sm px-3 py-1 rounded-full border border-red-200 hover:border-red-300 hover:bg-red-50">
                                                <i class="fas fa-trash mr-1"></i> Remover Fundo
                                            </button>
                                        </div>
                                        <div id="bgPlaceholder">
                                            <i class="fas fa-image text-4xl text-gray-400 mb-4"></i>
                                            <p class="text-sm text-gray-600 mb-2">Clique para fazer upload da imagem</p>
                                            <p class="text-xs text-gray-500">PNG, JPG até 5MB</p>
                                        </div>
                                        <input type="file" id="bgFile" name="background_image" accept="image/*" class="hidden">
                                    </div>
                                </div>
                            </div>
                        </div>
=======
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ __('companies.google_business') }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('companies.google_business_desc') }}</p>
>>>>>>> Perfil-gerenciamento-usuarios
                    </div>
                </div>
                
                <div>
                    <label for="google_business_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('companies.google_business_url') }}
                    </label>
                    <input 
                        type="url" 
                        id="google_business_url" 
                        name="google_business_url"
                        class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="{{ __('companies.google_business_url_placeholder') }}"
                    >
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        {{ __('companies.google_business_url_desc') }}
                    </p>
                </div>
            </div>
            
            <!-- Personalização Visual -->
            <div class="form-section p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-palette text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ __('companies.visual_customization') }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('companies.visual_customization_desc') }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.logo') }}
                        </label>
                        <div class="upload-area rounded-lg p-8 text-center cursor-pointer bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600" onclick="document.getElementById('logo').click()">
                            <div id="logoPreview" class="hidden mb-4">
                                <img id="logoPreviewImg" src="" alt="Preview" class="w-20 h-20 object-contain mx-auto rounded-lg border-2 border-gray-200 dark:border-gray-600">
                            </div>
                            <div id="logoPlaceholder">
                                <i class="fas fa-image text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('companies.upload_click') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('companies.upload_png_jpg') }}</p>
                            </div>
                            <input type="file" id="logo" name="logo" accept="image/*" class="hidden" onchange="handleFileUpload(this, 'logo')">
                        </div>
                    </div>
                    
                    <!-- Background Image Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('companies.background_image') }}
                        </label>
                        <div class="upload-area rounded-lg p-8 text-center cursor-pointer bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600" onclick="document.getElementById('background_image').click()">
                            <div id="bgPreview" class="hidden mb-4">
                                <img id="bgPreviewImg" src="" alt="Preview" class="w-20 h-20 object-cover mx-auto rounded-lg border-2 border-gray-200 dark:border-gray-600">
                            </div>
                            <div id="bgPlaceholder">
                                <i class="fas fa-image text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('companies.upload_click') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('companies.upload_bg_png_jpg') }}</p>
                            </div>
                            <input type="file" id="background_image" name="background_image" accept="image/*" class="hidden" onchange="handleFileUpload(this, 'background')">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // Formatação de Telefone
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('contact_number');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é dígito
                    if (value.length > 11) {
                        value = value.substring(0, 11); // Limita a 11 dígitos
                    }
                    
                    // Aplica a máscara
                    if (value.length > 10) {
                        // Telefone com 11 dígitos (celular): (XX) XXXXX-XXXX
                        e.target.value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 7) + '-' + value.substring(7);
                    } else if (value.length > 6) {
                        // Telefone com 10 dígitos (fixo): (XX) XXXX-XXXX
                        e.target.value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 6) + '-' + value.substring(6);
                    } else if (value.length > 2) {
                        // Começou a digitar: (XX) XXX
                        e.target.value = '(' + value.substring(0, 2) + ') ' + value.substring(2);
                    } else if (value.length > 0) {
                        // Apenas DDD: (XX
                        e.target.value = '(' + value;
                    }
                });
            }
        });
        
        // Star Rating Display
        function updateStarDisplay(value) {
            document.getElementById('starCount').textContent = value;
<<<<<<< HEAD
        }
        
        // Phone number formatting function
        function formatPhoneNumber(input) {
            // Remove all non-numeric characters
            let value = input.value.replace(/\D/g, '');
            
            // Limit to 11 digits (DDD + 9 digits)
            if (value.length > 11) {
                value = value.substring(0, 11);
            }
            
            // Format based on length
            if (value.length <= 2) {
                // Just DDD: (11
                input.value = value.length > 0 ? `(${value}` : '';
            } else if (value.length <= 6) {
                // DDD + first part: (11) 9999
                input.value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
            } else if (value.length <= 10) {
                // DDD + first part + second part: (11) 9999-9999
                input.value = `(${value.substring(0, 2)}) ${value.substring(2, 6)}-${value.substring(6)}`;
            } else {
                // DDD + first part + second part: (11) 99999-9999
                input.value = `(${value.substring(0, 2)}) ${value.substring(2, 7)}-${value.substring(7)}`;
            }
        }
        
        // Submit form function
        function submitForm() {
            console.log('submitForm() chamada');
            
            const form = document.getElementById('companyForm');
            
            if (!form) {
                console.error('Formulário não encontrado!');
                showNotification('Erro: Formulário não encontrado!', 'error');
                return;
=======
            const starIcons = document.getElementById('starIcons');
            starIcons.innerHTML = '';
            for (let i = 0; i < value; i++) {
                starIcons.innerHTML += '<i class="fas fa-star"></i>';
>>>>>>> Perfil-gerenciamento-usuarios
            }
            updateProgress();
        }
        
        // File Upload Handler
        function handleFileUpload(input, type) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (type === 'logo') {
                        document.getElementById('logoPreviewImg').src = e.target.result;
                        document.getElementById('logoPreview').classList.remove('hidden');
                        document.getElementById('logoPlaceholder').classList.add('hidden');
                    } else {
                        document.getElementById('bgPreviewImg').src = e.target.result;
                        document.getElementById('bgPreview').classList.remove('hidden');
                        document.getElementById('bgPlaceholder').classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
<<<<<<< HEAD
            
            console.log('Validação passou, submetendo formulário...');
            
            // Mostrar loading
            const submitBtn = document.querySelector('button[onclick="submitForm()"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> ATIVANDO...';
            submitBtn.disabled = true;
            
            // Submeter formulário
            form.submit();
        }
        
        // Save form function (para salvar como rascunho)
        function saveForm() {
            console.log('saveForm() chamada');
            
            const form = document.getElementById('companyForm');
            
            if (!form) {
                console.error('Formulário não encontrado!');
                showNotification('Erro: Formulário não encontrado!', 'error');
                return;
            }
            
            console.log('Formulário encontrado:', form);
            
            // Adicionar campo hidden para indicar que é rascunho
            const draftInput = document.createElement('input');
            draftInput.type = 'hidden';
            draftInput.name = 'save_as_draft';
            draftInput.value = 'true';
            form.appendChild(draftInput);
            
            console.log('Salvando como rascunho...');
            
            // Mostrar loading
            const saveBtn = document.querySelector('button[onclick="saveForm()"]');
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> SALVANDO...';
            saveBtn.disabled = true;
            
            // Submeter formulário
            form.submit();
        }
        
        // Show notification
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
=======
            updateProgress();
        }
        
        // Progress Tracking
        function updateProgress() {
            const fields = [
                'name',
                'url',
                'negative_email',
                'business_website',
                'contact_number',
                'business_address',
                'google_business_url'
            ];
>>>>>>> Perfil-gerenciamento-usuarios
            
            let completed = 0;
            fields.forEach(field => {
                const element = document.getElementById(field);
                if (element && element.value.trim() !== '') {
                    completed++;
                }
            });
            
            const progress = (completed / fields.length) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
            const fieldsText = document.getElementById('progressText').dataset.fieldsText || 'campos preenchidos';
            document.getElementById('progressText').textContent = `${completed}/${fields.length} ${fieldsText}`;
        }
        
        // Add event listeners to form fields
        document.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', updateProgress);
        });
        
        // Drag and drop functionality
        document.querySelectorAll('.upload-area').forEach(area => {
            area.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('dragover');
            });
            
            area.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
            });
            
            area.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('dragover');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const input = this.querySelector('input[type="file"]');
                    input.files = files;
                    const type = input.id === 'logo' ? 'logo' : 'background';
                    handleFileUpload(input, type);
                }
            });
        });
        
        // Form submission - prevent double submit
        document.getElementById('companyForm').addEventListener('submit', function(e) {
            const submitButtons = document.querySelectorAll('button[type="submit"], button[onclick*="submit"]');
            submitButtons.forEach(button => {
                if (!button.disabled) {
                    const savingText = 'Salvando...';
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>' + savingText;
                    button.disabled = true;
                }
            });
        });
    </script>
@endsection
