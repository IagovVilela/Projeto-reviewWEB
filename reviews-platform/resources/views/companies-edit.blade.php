<<<<<<< HEAD
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empresa - Reviews Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/assets/js/google-reviews-system.js"></script>
    <style>
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(108, 117, 125, 0.3);
        }
        .form-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            border: 1px solid #dee2e6;
        }
        .upload-area {
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            border-color: #667eea;
            background-color: #f8f9ff;
        }
        .upload-area.dragover {
            border-color: #667eea;
            background-color: #f0f4ff;
        }
        .progress-bar {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            transition: width 0.3s ease;
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-draft {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">Reviews Platform</h1>
            </div>
            <nav class="mt-6">
                <a href="/dashboard" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-800 transition-colors">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="/companies" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-800 transition-colors">
                    <i class="fas fa-building mr-3"></i>
                    Empresas
                </a>
                <a href="/reviews" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-800 transition-colors">
                    <i class="fas fa-star mr-3"></i>
                    Avaliações
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="/companies" class="text-gray-600 hover:text-gray-800 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            VOLTAR
                        </a>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">Status:</span>
                            <span class="status-badge status-{{ $company->status }}">
                                {{ $company->status === 'draft' ? 'Rascunho' : 'Ativo' }}
                            </span>
                        </div>
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
                    <h1 class="text-3xl font-bold text-gray-800 mb-6">EDITAR EMPRESA</h1>
                    
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
                    <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data" id="companyForm">
                        @csrf
                        @method('PUT')
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
                                            value="{{ old('name', $company->name) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="Digite o nome da sua empresa"
                                        >
                                    </div>
                                    
                                    <!-- URL -->
                                    <div>
                                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">
                                            URL Personalizada
                                        </label>
                                        <input 
                                            type="text" 
                                            id="url" 
                                            name="url"
                                            value="{{ old('url', $company->url) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="exemplo.com"
                                        >
                                    </div>
                                    
                                    <!-- Negative Email -->
                                    <div>
                                        <label for="negativeEmail" class="block text-sm font-medium text-gray-700 mb-2">
                                            Email para Feedback Negativo
                                        </label>
                                        <input 
                                            type="email" 
                                            id="negativeEmail" 
                                            name="negative_email"
                                            value="{{ old('negative_email', $company->negative_email) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="contato@empresa.com"
                                        >
                                    </div>
                                    
                                    <!-- Contact Number -->
                                    <div>
                                        <label for="contactNumber" class="block text-sm font-medium text-gray-700 mb-2">
                                            Número de Contato
                                        </label>
                                        <input 
                                            type="text" 
                                            id="contactNumber" 
                                            name="contact_number"
                                            value="{{ old('contact_number', $company->contact_number) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="(11) 99999-9999"
                                            maxlength="15"
                                            oninput="formatPhoneNumber(this)"
                                        >
                                    </div>
                                </div>
                                
                                <!-- Right Column -->
                                <div class="space-y-6">
                                    <!-- Business Website -->
                                    <div>
                                        <label for="businessWebsite" class="block text-sm font-medium text-gray-700 mb-2">
                                            Site da Empresa
                                        </label>
                                        <input 
                                            type="url" 
                                            id="businessWebsite" 
                                            name="business_website"
                                            value="{{ old('business_website', $company->business_website) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="https://www.empresa.com"
                                        >
                                    </div>
                                    
                                    <!-- Business Address -->
                                    <div>
                                        <label for="businessAddress" class="block text-sm font-medium text-gray-700 mb-2">
                                            Endereço da Empresa
                                        </label>
                                        <textarea 
                                            id="businessAddress" 
                                            name="business_address"
                                            rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="Rua, Número, Bairro, Cidade - Estado"
                                        >{{ old('business_address', $company->business_address) }}</textarea>
                                    </div>
                                    
                                    <!-- Google Business URL -->
                                    <div>
                                        <label for="googleBusinessUrl" class="block text-sm font-medium text-gray-700 mb-2">
                                            URL do Google Business
                                        </label>
                                        <input 
                                            type="url" 
                                            id="googleBusinessUrl" 
                                            name="google_business_url"
                                            value="{{ old('google_business_url', $company->google_business_url) }}"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                            placeholder="https://g.page/empresa"
                                        >
                                    </div>
                                    
                                    <!-- Positive Score -->
                                    <div>
                                        <label for="positiveScore" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nota Mínima para Positiva
                                        </label>
                                        <select 
                                            id="positiveScore" 
                                            name="positive_score"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                        >
                                            <option value="3" {{ old('positive_score', $company->positive_score) == 3 ? 'selected' : '' }}>3 estrelas</option>
                                            <option value="4" {{ old('positive_score', $company->positive_score) == 4 ? 'selected' : '' }}>4 estrelas</option>
                                            <option value="5" {{ old('positive_score', $company->positive_score) == 5 ? 'selected' : '' }}>5 estrelas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- UPLOAD IMAGES Section -->
                        <div class="form-section p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">UPLOAD DE IMAGENS</h2>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Logo Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Logo da Empresa
                                    </label>
                                    <div class="upload-area p-6 text-center rounded-lg cursor-pointer" onclick="document.getElementById('logoFile').click()">
                                        <input type="file" id="logoFile" name="logo" accept="image/*" class="hidden">
                                        <div class="space-y-2">
                                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                            <p class="text-gray-600">Clique para fazer upload da logo</p>
                                            <p class="text-sm text-gray-500">PNG, JPG até 2MB</p>
                                        </div>
                                        @if($company->logo)
                                        <div class="mt-4">
                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo atual" class="mx-auto h-20 w-20 object-cover rounded-lg">
                                            <p class="text-sm text-green-600 mt-2">Logo atual</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Background Upload -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Imagem de Fundo
                                    </label>
                                    <div class="upload-area p-6 text-center rounded-lg cursor-pointer" onclick="document.getElementById('bgFile').click()">
                                        <input type="file" id="bgFile" name="background_image" accept="image/*" class="hidden">
                                        <div class="space-y-2">
                                            <i class="fas fa-image text-4xl text-gray-400"></i>
                                            <p class="text-gray-600">Clique para fazer upload do fundo</p>
                                            <p class="text-sm text-gray-500">PNG, JPG até 2MB</p>
                                        </div>
                                        @if($company->background_image)
                                        <div class="mt-4">
                                            <img src="{{ asset('storage/' . $company->background_image) }}" alt="Fundo atual" class="mx-auto h-20 w-20 object-cover rounded-lg">
                                            <p class="text-sm text-green-600 mt-2">Fundo atual</p>
                                        </div>
                                        @endif
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

    <script>
        // Format phone number function
        function formatPhoneNumber(input) {
            let value = input.value.replace(/\D/g, '');
            
            if (value.length <= 11) {
                if (value.length <= 2) {
                    input.value = value;
                } else if (value.length <= 6) {
                    input.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
                } else if (value.length <= 10) {
                    input.value = `(${value.slice(0, 2)}) ${value.slice(2, 6)}-${value.slice(6)}`;
                } else {
                    input.value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
                }
            }
        }
        
        // Handle file upload
        function handleFileUpload(input, type) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const uploadArea = input.closest('.upload-area');
                    const preview = uploadArea.querySelector('.preview-image');
                    
                    if (!preview) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'preview-image mt-4';
                        previewDiv.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="mx-auto h-20 w-20 object-cover rounded-lg">
                            <p class="text-sm text-green-600 mt-2">Nova imagem selecionada</p>
                        `;
                        uploadArea.appendChild(previewDiv);
                    } else {
                        preview.querySelector('img').src = e.target.result;
                        preview.querySelector('p').textContent = 'Nova imagem selecionada';
                    }
                };
                reader.readAsDataURL(file);
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
            document.querySelector('.text-sm.font-medium.text-gray-600').textContent = `${completed}/${fields.length} etapas completas`;
        }
        
        // Update progress on input change
        document.addEventListener('DOMContentLoaded', function() {
            updateProgress();
            
            document.querySelectorAll('input, textarea, select').forEach(element => {
                element.addEventListener('input', updateProgress);
                element.addEventListener('change', updateProgress);
            });
        });
        
        // File upload event listeners
        document.getElementById('logoFile').addEventListener('change', function() {
            handleFileUpload(this, 'logo');
        });
        
        document.getElementById('bgFile').addEventListener('change', function() {
            handleFileUpload(this, 'background');
        });
    </script>
</body>
</html>
=======
@extends('layouts.admin')

@section('title', 'Editar Empresa - Reviews Platform')

@section('page-title', 'Editar Empresa: ' . $company->name)

@section('header-actions')
    <a href="/companies" class="text-gray-600 hover:text-gray-800 transition-colors mr-4">
        <i class="fas fa-arrow-left mr-2"></i>
        Voltar
    </a>
    <span class="px-3 py-1 text-sm font-medium rounded-full {{ $company->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} mr-4">
        {{ $company->status === 'published' ? 'Ativo' : 'Rascunho' }}
    </span>
    <button type="button" onclick="submitForm()" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-upload mr-2"></i>
        ATIVAR
    </button>
    <button type="button" onclick="saveForm()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-save mr-2"></i>
        SALVAR
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
    }
    .slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: var(--primary-gradient);
        border-radius: 50%;
        cursor: pointer;
        border: none;
    }
</style>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <form method="POST" action="{{ route('companies.update', $company->id) }}" enctype="multipart/form-data" id="companyForm" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Dados Básicos -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Dados Básicos</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome da Empresa *</label>
                    <input type="text" name="name" value="{{ old('name', $company->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL Personalizada</label>
                    <input type="text" name="url" value="{{ old('url', $company->url) }}" placeholder="minha-empresa" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-sm text-gray-500 mt-1">Usado na URL: meusite.com/minha-empresa</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email para Avaliações Negativas *</label>
                    <input type="email" name="negative_email" value="{{ old('negative_email', $company->negative_email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                </div>
            </div>
        </div>

        <!-- Upload de Imagens -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Imagens</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Logo da Empresa</label>
                    <div class="upload-area rounded-lg p-4 text-center cursor-pointer">
                        @if($company->logo_url)
                            <img src="{{ $company->logo_url }}" alt="Logo atual" class="max-w-xs mx-auto mb-2">
                        @endif
                        <input type="file" name="logo" accept="image/*" class="hidden" id="logoInput">
                        <button type="button" onclick="document.getElementById('logoInput').click()" class="text-purple-600 hover:text-purple-700">
                            <i class="fas fa-upload mr-2"></i>Trocar Logo
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Imagem de Fundo</label>
                    <div class="upload-area rounded-lg p-4 text-center cursor-pointer">
                        @if($company->background_image_url)
                            <img src="{{ $company->background_image_url }}" alt="Background atual" class="max-w-xs mx-auto mb-2">
                        @endif
                        <input type="file" name="background_image" accept="image/*" class="hidden" id="backgroundInput">
                        <button type="button" onclick="document.getElementById('backgroundInput').click()" class="text-purple-600 hover:text-purple-700">
                            <i class="fas fa-upload mr-2"></i>Trocar Background
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informações de Contato -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Informações de Contato</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Telefone de Contato</label>
                    <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $company->contact_number) }}" placeholder="(11) 99999-9999" class="w-full px-4 py-2 border border-gray-300 rounded-lg" maxlength="15">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site da Empresa</label>
                    <input type="url" name="business_website" value="{{ old('business_website', $company->business_website) }}" placeholder="https://www.exemplo.com" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Endereço</label>
                    <input type="text" name="business_address" value="{{ old('business_address', $company->business_address) }}" placeholder="Rua, Número, Bairro" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL do Google Meu Negócio</label>
                    <input type="url" name="google_business_url" value="{{ old('google_business_url', $company->google_business_url) }}" placeholder="https://g.page/exemplo" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </div>
        </div>

        <!-- Configurações -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Configurações de Avaliação</h2>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nota mínima para considerar positivo *
                    <span class="text-purple-600 ml-2" id="positiveScoreValue">{{ old('positive_score', $company->positive_score) }}</span>
                </label>
                <input type="range" name="positive_score" min="1" max="5" value="{{ old('positive_score', $company->positive_score) }}" class="slider w-full" id="positiveScoreSlider" required>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Muito Restritivo (1)</span>
                    <span>Muito Permissivo (5)</span>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('positiveScoreSlider');
    const valueDisplay = document.getElementById('positiveScoreValue');
    
    slider.addEventListener('input', function() {
        valueDisplay.textContent = this.value;
    });
    
    // Formatação de telefone
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

function saveForm() {
    const form = document.getElementById('companyForm');
    if (!form) {
        console.error('Formulário não encontrado!');
        showNotification('Erro: Formulário não encontrado!', 'error');
        return;
    }
    
    const draftInput = document.createElement('input');
    draftInput.type = 'hidden';
    draftInput.name = 'save_as_draft';
    draftInput.value = 'true';
    form.appendChild(draftInput);
    
    const saveBtn = document.querySelector('button[onclick="saveForm()"]');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> SALVANDO...';
    saveBtn.disabled = true;
    
    form.submit();
}

function submitForm() {
    const form = document.getElementById('companyForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    const submitBtn = document.querySelector('button[onclick="submitForm()"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> ATIVANDO...';
    submitBtn.disabled = true;
    
    form.submit();
}

function showNotification(message, type) {
    alert(message);
}
</script>
@endsection
>>>>>>> Perfil-gerenciamento-usuarios
