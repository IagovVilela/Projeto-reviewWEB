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
        width: 100%;
    }
    
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #8b5cf6;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(139, 92, 246, 0.3);
        transition: all 0.3s ease;
        border: 2px solid #ffffff;
    }
    
    .slider::-webkit-slider-thumb:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
    }
    
    .slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #8b5cf6;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 6px rgba(139, 92, 246, 0.3);
        transition: all 0.3s ease;
    }
    
    .slider::-moz-range-thumb:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
    }
    
    /* Dark mode support */
    .dark .slider {
        background: #374151;
    }
    
    .dark .slider::-webkit-slider-thumb {
        background: #8b5cf6;
        border-color: #1f2937;
    }
    
    .dark .slider::-moz-range-thumb {
        background: #8b5cf6;
        border-color: #1f2937;
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
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">{{ __('companies.positive_score') }}</h2>
            
            <div>
                <label for="positive_score" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('companies.positive_score_label') }} *
                </label>
                <div class="flex items-center space-x-4">
                    <input 
                        type="range" 
                        name="positive_score" 
                        id="positiveScoreSlider"
                        min="1" 
                        max="5" 
                        value="{{ old('positive_score', $company->positive_score ?? 4) }}" 
                        class="flex-1 slider" 
                        required
                    >
                    <div class="flex items-center space-x-2 min-w-[120px]">
                        <span id="positiveScoreValue" class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ old('positive_score', $company->positive_score ?? 4) }}</span>
                        <div class="flex text-yellow-400" id="positiveScoreStars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= (old('positive_score', $company->positive_score ?? 4)))
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-2">
                    <span>{{ __('companies.very_restrictive') }} (1)</span>
                    <span>{{ __('companies.very_permissive') }} (5)</span>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    {{ __('companies.positive_score_desc') }}
                </p>
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
    const starsContainer = document.getElementById('positiveScoreStars');
    
    if (slider && valueDisplay && starsContainer) {
        function updateStarDisplay(value) {
            valueDisplay.textContent = value;
            starsContainer.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('i');
                star.className = i <= value ? 'fas fa-star' : 'far fa-star';
                starsContainer.appendChild(star);
            }
        }
        
        // Update on input
        slider.addEventListener('input', function() {
            updateStarDisplay(this.value);
        });
        
        // Initial update
        updateStarDisplay(slider.value);
    }
    
    // Formatação de telefone
    const phoneInput = document.getElementById('contact_number');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) {
                value = value.substring(0, 11);
            }
            
            if (value.length > 10) {
                e.target.value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 7) + '-' + value.substring(7);
            } else if (value.length > 6) {
                e.target.value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 6) + '-' + value.substring(6);
            } else if (value.length > 2) {
                e.target.value = '(' + value.substring(0, 2) + ') ' + value.substring(2);
            } else if (value.length > 0) {
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
