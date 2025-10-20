<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Empresa - Reviews Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/modern-styles.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .sidebar-gradient {
            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .nav-item {
            transition: all 0.3s ease;
        }
        
        .nav-item:hover {
            background-color: rgba(139, 92, 246, 0.1);
            color: #8b5cf6;
        }
        
        .nav-item.active {
            background-color: rgba(139, 92, 246, 0.15);
            color: #8b5cf6;
            font-weight: 600;
        }
        
        .logo-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }
        
        .btn-secondary {
            background: #6b7280;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: #4b5563;
            transform: translateY(-1px);
        }
        
        .progress-bar {
            background: linear-gradient(90deg, #8b5cf6 0%, #ec4899 100%);
        }
        
        .form-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .upload-area {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }
        
        .upload-area:hover {
            border-color: #8b5cf6;
            background-color: rgba(139, 92, 246, 0.05);
        }
        
        .upload-area.dragover {
            border-color: #8b5cf6;
            background-color: rgba(139, 92, 246, 0.1);
        }
        
        .remove-btn {
            transition: all 0.3s ease;
        }
        
        .remove-btn:hover {
            transform: scale(1.05);
            background-color: rgba(239, 68, 68, 0.1);
        }
        
        .preview-container {
            position: relative;
        }
        
        .preview-container:hover .remove-btn {
            opacity: 1;
        }
        
        .help-link {
            color: #8b5cf6;
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        .help-link:hover {
            text-decoration: underline;
        }
        
        /* Custom Slider Styles */
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
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
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
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
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
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient border-r border-gray-200 flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 logo-gradient rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-800">Reviews Platform</h1>
                        <p class="text-xs text-gray-500">Sistema de Avaliações</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="/dashboard" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    Dashboard
                </a>
                <a href="/companies" class="nav-item active flex items-center px-3 py-2 rounded-lg text-sm font-medium">
                    <i class="fas fa-th w-5 h-5 mr-3"></i>
                    Empresas
                </a>
                <a href="/reviews" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="far fa-star w-5 h-5 mr-3"></i>
                    Avaliações
                </a>
                <a href="/subscription" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-sliders-h w-5 h-5 mr-3"></i>
                    Assinatura
                </a>
                <a href="/billing" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="far fa-credit-card w-5 h-5 mr-3"></i>
                    Cobrança
                </a>
                <a href="/invoices" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-file-alt w-5 h-5 mr-3"></i>
                    Faturas
                </a>
                <a href="/profile" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-user w-5 h-5 mr-3"></i>
                    Perfil
                </a>
                <a href="/emails" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-envelope w-5 h-5 mr-3"></i>
                    Emails
                </a>
                <a href="/store" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-shopping-cart w-5 h-5 mr-3"></i>
                    Loja
                </a>
                <a href="/support" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-life-ring w-5 h-5 mr-3"></i>
                    Suporte
                </a>
                <a href="/faqs" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-question-circle w-5 h-5 mr-3"></i>
                    FAQs
                </a>
                <a href="/logout" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                    Sair
                </a>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="/companies" class="text-gray-600 hover:text-gray-800 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            VOLTAR
                        </a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button type="button" onclick="submitForm()" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-upload mr-2"></i>
                            ATIVAR
                        </button>
                        <button type="button" onclick="saveForm()" class="btn-secondary text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-save mr-2"></i>
                            SALVAR
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="max-w-4xl mx-auto">
                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-gray-800 mb-6">CRIAR EMPRESA</h1>
                    
                    <!-- Progress Bar -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-600">0/6 etapas completas</span>
                            <span class="text-sm text-gray-500">(O que está faltando?)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="progress-bar h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                    
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
                    </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    
    <script src="/assets/js/google-reviews-system.js"></script>
    <script>
        // Update star display
        function updateStarDisplay(value) {
            document.getElementById('starCount').textContent = value;
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
            }
            
            console.log('Formulário encontrado:', form);
            
            const businessName = document.getElementById('businessName').value;
            const negativeEmail = document.getElementById('negativeEmail').value;
            
            console.log('Nome:', businessName);
            console.log('Email:', negativeEmail);
            
            // Validação básica
            if (!businessName || !negativeEmail) {
                showNotification('Por favor, preencha pelo menos o nome da empresa e email de feedback negativo.', 'error');
                return;
            }
            
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
            
            Object.assign(notification.style, {
                position: 'fixed',
                top: '20px',
                right: '20px',
                padding: '1rem 1.5rem',
                borderRadius: '12px',
                color: 'white',
                fontWeight: '500',
                zIndex: '1000',
                transform: 'translateX(100%)',
                transition: 'transform 0.3s ease',
                background: type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6',
                maxWidth: '400px',
                boxShadow: '0 10px 25px rgba(0, 0, 0, 0.1)'
            });
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
        
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
                    handleFileUpload(input, 'file');
                }
            });
        });
        
        // Form validation and progress update
        function updateProgress() {
            const fields = [
                'businessName',
                'url',
                'negativeEmail',
                'positiveScore',
                'businessWebsite',
                'contactNumber',
                'businessAddress'
            ];
            
            let completed = 0;
            fields.forEach(field => {
                const element = document.getElementById(field);
                if (element && element.value.trim() !== '') {
                    completed++;
                }
            });
            
            const progress = (completed / fields.length) * 100;
            document.querySelector('.progress-bar').style.width = progress + '%';
            
            // Update progress text
            const progressText = document.querySelector('.text-sm.font-medium.text-gray-600');
            progressText.textContent = `${completed}/${fields.length} etapas completas`;
        }
        
        // Category filter functionality
        document.querySelectorAll('.category-filter').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.category-filter').forEach(btn => {
                    btn.classList.remove('bg-purple-100', 'text-purple-700');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                });
                
                // Add active class to clicked button
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-purple-100', 'text-purple-700');
                
                // Filter platforms
                const category = this.getAttribute('data-category');
                filterPlatforms(category);
            });
        });
        
        // Platform filtering function
        function filterPlatforms(category) {
            const platforms = document.querySelectorAll('.platform-card');
            
            platforms.forEach(platform => {
                const platformCategories = platform.getAttribute('data-category');
                
                if (category === 'all' || platformCategories.includes(category)) {
                    platform.style.display = 'block';
                } else {
                    platform.style.display = 'none';
                }
            });
        }
        
        // Search functionality
        document.getElementById('platformSearch').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const platforms = document.querySelectorAll('.platform-card');
            
            platforms.forEach(platform => {
                const platformName = platform.querySelector('h3').textContent.toLowerCase();
                
                if (platformName.includes(searchTerm)) {
                    platform.style.display = 'block';
                } else {
                    platform.style.display = 'none';
                }
            });
        });
        
        // Platform selection limit
        document.querySelectorAll('input[name="platforms[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const checkedBoxes = document.querySelectorAll('input[name="platforms[]"]:checked');
                
                if (checkedBoxes.length > 5) {
                    alert('Você pode selecionar no máximo 5 plataformas.');
                    this.checked = false;
                }
            });
        });
        
        // Add event listeners for form fields
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', updateProgress);
            input.addEventListener('change', updateProgress);
        });
        
        // Save button functionality
        document.querySelector('.btn-secondary').addEventListener('click', function() {
            // Collect form data
            const formData = {
                businessName: document.getElementById('businessName').value,
                url: document.getElementById('url').value,
                negativeEmail: document.getElementById('negativeEmail').value,
                positiveScore: document.getElementById('positiveScore').value,
                prizeDraw: document.getElementById('prizeDraw').checked,
                logoFile: document.getElementById('logoFile').files[0],
                bgFile: document.getElementById('bgFile').files[0]
            };
            
            console.log('Form data:', formData);
            alert('Dados salvos com sucesso!');
        });
        
        // Publish button functionality
        document.querySelector('.btn-primary').addEventListener('click', function() {
            const businessName = document.getElementById('businessName').value;
            const url = document.getElementById('url').value;
            const negativeEmail = document.getElementById('negativeEmail').value;
            
            if (!businessName || !url || !negativeEmail) {
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }
            
            alert('Empresa publicada com sucesso!');
        });
    </script>
</body>
</html>
