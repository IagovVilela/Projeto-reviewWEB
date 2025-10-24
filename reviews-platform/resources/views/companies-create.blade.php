@extends('layouts.admin')

@section('title', 'Criar Empresa - Reviews Platform')

@section('page-title', 'Criar Nova Empresa')
@section('page-description', 'Preencha os dados para criar uma nova empresa')

@section('header-actions')
    <a href="/companies" class="text-gray-600 hover:text-gray-800 transition-colors mr-4">
        <i class="fas fa-arrow-left mr-2"></i>
        Voltar
    </a>
    <button type="button" onclick="document.getElementById('companyForm').submit()" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-save mr-2"></i>
        Salvar Empresa
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
            background: var(--primary-gradient);
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
            background: var(--primary-gradient);
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
        <div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-600">Progresso do cadastro</span>
                <span class="text-sm text-gray-500" id="progressText">0/7 campos preenchidos</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progressBar" class="h-2 rounded-full transition-all duration-300" style="width: 0%; background: var(--primary-gradient);"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data" id="companyForm" class="space-y-6">
            @csrf
            
            <!-- Informações Básicas -->
            <div class="form-section p-6">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 icon-gradient rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-building text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Informações Básicas</h2>
                        <p class="text-sm text-gray-600">Dados principais da empresa</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Nome da Empresa -->
                    <div class="lg:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome da Empresa *
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Digite o nome da empresa"
                        >
                    </div>
                    
                    <!-- URL -->
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">
                            URL Personalizada *
                        </label>
                        <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-500 bg-gray-50 border border-r-0 border-gray-300 rounded-l-lg">
                                rateus.io/
                            </span>
                            <input 
                                type="text" 
                                id="url" 
                                name="url"
                                required
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="sua-empresa"
                            >
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Somente letras minúsculas, números e hífens
                        </p>
                    </div>
                    
                    <!-- Email para Feedback Negativo -->
                    <div>
                        <label for="negative_email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email para Feedback Negativo *
                        </label>
                        <input 
                            type="email" 
                            id="negative_email" 
                            name="negative_email"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="contato@empresa.com"
                        >
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Avaliações negativas serão enviadas para este email
                        </p>
                    </div>
                    
                    <!-- Pontuação Positiva -->
                    <div class="lg:col-span-2">
                        <label for="positive_score" class="block text-sm font-medium text-gray-700 mb-2">
                            Limite de Avaliação Positiva
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
                                <span id="starCount" class="text-2xl font-bold text-purple-600">4</span>
                                <div class="flex text-yellow-400" id="starIcons">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Avaliações com esta nota ou superior serão direcionadas para o Google
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Detalhes da Empresa -->
            <div class="form-section p-6">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 icon-gradient rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Detalhes da Empresa</h2>
                        <p class="text-sm text-gray-600">Informações de contato e localização</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Website -->
                    <div>
                        <label for="business_website" class="block text-sm font-medium text-gray-700 mb-2">
                            Site da Empresa
                        </label>
                        <input 
                            type="url" 
                            id="business_website" 
                            name="business_website"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="https://www.suaempresa.com"
                        >
                    </div>
                    
                    <!-- Telefone -->
                    <div>
                        <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Telefone de Contato
                        </label>
                        <input 
                            type="tel" 
                            id="contact_number" 
                            name="contact_number"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="(11) 99999-9999"
                        >
                    </div>
                    
                    <!-- Endereço -->
                    <div class="lg:col-span-2">
                        <label for="business_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Endereço Completo
                        </label>
                        <textarea 
                            id="business_address" 
                            name="business_address"
                            rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                            placeholder="Rua, número, bairro, cidade, estado, CEP"
                        ></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Google My Business -->
            <div class="form-section p-6">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fab fa-google text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Google My Business</h2>
                        <p class="text-sm text-gray-600">Integração com avaliações do Google</p>
                    </div>
                </div>
                
                <div>
                    <label for="google_business_url" class="block text-sm font-medium text-gray-700 mb-2">
                        URL do Google My Business
                    </label>
                    <input 
                        type="url" 
                        id="google_business_url" 
                        name="google_business_url"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="https://g.page/sua-empresa"
                    >
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Avaliações positivas serão redirecionadas para este link
                    </p>
                </div>
            </div>
            
            <!-- Personalização Visual -->
            <div class="form-section p-6">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 icon-gradient rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-palette text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Personalização Visual</h2>
                        <p class="text-sm text-gray-600">Logo e imagem de fundo (opcional)</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Logo da Empresa
                        </label>
                        <div class="upload-area rounded-lg p-8 text-center cursor-pointer" onclick="document.getElementById('logo').click()">
                            <div id="logoPreview" class="hidden mb-4">
                                <img id="logoPreviewImg" src="" alt="Preview" class="w-20 h-20 object-contain mx-auto rounded-lg border-2 border-gray-200">
                            </div>
                            <div id="logoPlaceholder">
                                <i class="fas fa-image text-4xl text-gray-400 mb-4"></i>
                                <p class="text-sm text-gray-600 mb-2">Clique para fazer upload</p>
                                <p class="text-xs text-gray-500">PNG, JPG até 2MB</p>
                            </div>
                            <input type="file" id="logo" name="logo" accept="image/*" class="hidden" onchange="handleFileUpload(this, 'logo')">
                        </div>
                    </div>
                    
                    <!-- Background Image Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Imagem de Fundo
                        </label>
                        <div class="upload-area rounded-lg p-8 text-center cursor-pointer" onclick="document.getElementById('background_image').click()">
                            <div id="bgPreview" class="hidden mb-4">
                                <img id="bgPreviewImg" src="" alt="Preview" class="w-20 h-20 object-cover mx-auto rounded-lg border-2 border-gray-200">
                            </div>
                            <div id="bgPlaceholder">
                                <i class="fas fa-image text-4xl text-gray-400 mb-4"></i>
                                <p class="text-sm text-gray-600 mb-2">Clique para fazer upload</p>
                                <p class="text-xs text-gray-500">PNG, JPG até 5MB</p>
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
        // Star Rating Display
        function updateStarDisplay(value) {
            document.getElementById('starCount').textContent = value;
            const starIcons = document.getElementById('starIcons');
            starIcons.innerHTML = '';
            for (let i = 0; i < value; i++) {
                starIcons.innerHTML += '<i class="fas fa-star"></i>';
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
            
            let completed = 0;
            fields.forEach(field => {
                const element = document.getElementById(field);
                if (element && element.value.trim() !== '') {
                    completed++;
                }
            });
            
            const progress = (completed / fields.length) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
            document.getElementById('progressText').textContent = `${completed}/${fields.length} campos preenchidos`;
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
                    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Salvando...';
                    button.disabled = true;
                }
            });
        });
    </script>
@endsection
