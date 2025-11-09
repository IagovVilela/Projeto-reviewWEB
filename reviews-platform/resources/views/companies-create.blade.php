@extends('layouts.admin')

@section('title', __('companies.create') . ' - Reviews Platform')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
<style>
    /* Estilização do Slider de Zoom */
    #zoomSlider {
        background: linear-gradient(to right, #4b5563 0%, #a78bfa 50%, #4b5563 100%);
        height: 6px;
        border-radius: 4px;
    }
    
    #zoomSlider::-webkit-slider-thumb {
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.4);
        transition: all 0.2s ease;
        border: 2px solid white;
    }
    
    #zoomSlider::-webkit-slider-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.6);
    }
    
    #zoomSlider::-webkit-slider-thumb:active {
        transform: scale(1.05);
    }
    
    #zoomSlider::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
        cursor: pointer;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.4);
        transition: all 0.2s ease;
    }
    
    #zoomSlider::-moz-range-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.6);
    }
    
    #zoomSlider::-moz-range-thumb:active {
        transform: scale(1.05);
    }
    
    /* Animação do Modal */
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    #cropModal > div {
        animation: modalFadeIn 0.3s ease-out;
    }
    
    /* Controle do Cropper.js */
    #cropContainer {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #1a202c;
    }
    
    #cropContainer .cropper-container {
        width: 100% !important;
        height: 100% !important;
        max-height: 500px !important;
    }
    
    #cropContainer .cropper-canvas {
        max-width: 100% !important;
        max-height: 500px !important;
    }
    
    #cropContainer .cropper-view-box {
        outline: 3px solid #a78bfa !important;
        box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.6);
    }
    
    #cropContainer .cropper-line,
    #cropContainer .cropper-point {
        background-color: #a78bfa;
    }
    
    #cropContainer .cropper-point {
        width: 8px;
        height: 8px;
        opacity: 0.9;
    }
    
    #cropContainer .cropper-bg {
        background-image: none;
    }
</style>
@endsection

@section('page-title', __('companies.create_company'))
@section('page-description', __('companies.create_company_desc'))

@section('header-actions')
    <div class="flex items-center gap-2 sm:gap-4">
        <a href="/companies" class="text-gray-600 hover:text-gray-800 transition-colors hidden sm:inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            <span>{{ __('companies.back') }}</span>
        </a>
        <button type="button" onclick="document.getElementById('companyForm').submit()" class="btn-primary text-white px-3 sm:px-4 py-2 rounded-lg font-medium text-sm sm:text-base whitespace-nowrap">
            <i class="fas fa-save mr-2"></i>
            <span class="hidden sm:inline">{{ __('companies.save_company') }}</span>
            <span class="sm:hidden">{{ __('companies.save') }}</span>
        </button>
    </div>
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
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ __('companies.company_details') }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('companies.company_details_desc') }}</p>
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
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ __('companies.google_business') }}</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('companies.google_business_desc') }}</p>
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

    <!-- Modal de Crop -->
    <div id="cropModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.95); align-items: center; justify-content: center; padding: 20px;">
        <div style="width: 100%; max-width: 1000px; background: #2d3748; border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.9); overflow: hidden;">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-crop-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Ajustar Logo</h3>
                        <p class="text-purple-100 text-xs">Posicione e ajuste sua imagem</p>
                    </div>
                </div>
                <button type="button" onclick="cancelCrop()" class="w-8 h-8 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-lg flex items-center justify-center transition-all">
                    <i class="fas fa-times text-white"></i>
                </button>
            </div>
            
            <!-- Body -->
            <div class="p-6" style="background: #2d3748;">
                <!-- Container da Imagem -->
                <div id="cropContainer" style="width: 100%; height: 500px; background: #1a202c; border-radius: 12px; overflow: hidden; position: relative; box-shadow: inset 0 2px 8px rgba(0,0,0,0.3);">
                    <img id="cropImage" src="" alt="Crop" style="display: block; max-width: 100%;">
                </div>
                
                <!-- Controles -->
                <div class="mt-5 bg-gray-800 rounded-xl p-5">
                    <!-- Zoom -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-semibold text-gray-300 flex items-center">
                                <i class="fas fa-search-plus mr-2 text-purple-400"></i>Zoom
                            </span>
                            <span id="zoomLevel" class="text-xs text-gray-400 font-mono bg-gray-900 px-2 py-1 rounded">100%</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button" onclick="zoomCrop(-0.1)" class="w-10 h-10 bg-gray-700 hover:bg-purple-600 text-white rounded-lg transition-all flex items-center justify-center">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="range" id="zoomSlider" min="-1" max="1" step="0.01" value="0" class="flex-1 h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer" style="outline: none;" oninput="zoomSliderChange(this.value)">
                            <button type="button" onclick="zoomCrop(0.1)" class="w-10 h-10 bg-gray-700 hover:bg-purple-600 text-white rounded-lg transition-all flex items-center justify-center">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Ações Rápidas -->
                    <div class="flex items-center justify-between pt-3 border-t border-gray-700">
                        <button type="button" onclick="rotateCrop()" class="flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-all">
                            <i class="fas fa-redo mr-2"></i>
                            <span class="text-sm">Rotacionar 90°</span>
                        </button>
                        <button type="button" onclick="resetCrop()" class="flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-all">
                            <i class="fas fa-undo mr-2"></i>
                            <span class="text-sm">Resetar</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-900 px-6 py-4 flex justify-end items-center space-x-3">
                <button type="button" onclick="cancelCrop()" class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-all">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </button>
                <button type="button" onclick="applyCrop()" class="px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-check mr-2"></i>Aplicar Corte
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Carregar Cropper.js primeiro -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
    
    <script>
        // Aguardar Cropper.js carregar
        window.addEventListener('load', function() {
            console.log('Cropper disponível:', typeof Cropper !== 'undefined');
        });
        
        // Geração Automática de URL baseada no nome da empresa
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const urlInput = document.getElementById('url');
            let urlManuallyEdited = false;
            
            // Função para converter nome em slug
            function generateSlug(text) {
                return text
                    .toLowerCase()
                    .normalize('NFD') // Normaliza caracteres acentuados
                    .replace(/[\u0300-\u036f]/g, '') // Remove acentos
                    .replace(/[^\w\s-]/g, '') // Remove caracteres especiais
                    .replace(/\s+/g, '-') // Substitui espaços por hífens
                    .replace(/-+/g, '-') // Remove hífens duplicados
                    .replace(/^-+|-+$/g, ''); // Remove hífens no início e fim
            }
            
            // Gerar URL automaticamente quando nome mudar
            if (nameInput && urlInput) {
                nameInput.addEventListener('input', function(e) {
                    if (!urlManuallyEdited) {
                        const slug = generateSlug(e.target.value);
                        urlInput.value = slug;
                    }
                });
                
                // Marcar URL como editada manualmente quando usuário alterar
                urlInput.addEventListener('input', function() {
                    urlManuallyEdited = true;
                });
                
                // Se usuário limpar o campo URL, voltar a gerar automaticamente
                urlInput.addEventListener('blur', function() {
                    if (urlInput.value.trim() === '') {
                        urlManuallyEdited = false;
                        const slug = generateSlug(nameInput.value);
                        urlInput.value = slug;
                    }
                });
            }
            
            // Formatação de Telefone
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
            const starCount = document.getElementById('starCount');
            if (starCount) {
                starCount.textContent = value;
            }
            const starIcons = document.getElementById('starIcons');
            if (starIcons) {
                starIcons.innerHTML = '';
                for (let i = 0; i < value; i++) {
                    starIcons.innerHTML += '<i class="fas fa-star"></i>';
                }
            }
            updateProgress();
        }
        
        // Phone number formatting function
        function formatPhoneNumber(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length > 11) {
                value = value.substring(0, 11);
            }
            if (value.length > 10) {
                input.value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 7) + '-' + value.substring(7);
            } else if (value.length > 6) {
                input.value = '(' + value.substring(0, 2) + ') ' + value.substring(2, 6) + '-' + value.substring(6);
            } else if (value.length > 2) {
                input.value = '(' + value.substring(0, 2) + ') ' + value.substring(2);
            } else if (value.length > 0) {
                input.value = '(' + value;
            }
        }
        
        // File Upload Handler com Crop
        let cropper = null;
        let currentInput = null;
        let currentType = null;
        let originalFile = null;

        function handleFileUpload(input, type) {
            const file = input.files[0];
            if (file) {
                currentInput = input;
                currentType = type;
                originalFile = file;
                
                if (type === 'logo') {
                    // Processar logo com crop
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageData = e.target.result;
                        const image = document.getElementById('cropImage');
                        
                        // Destruir cropper anterior se existir
                        if (cropper) {
                            cropper.destroy();
                            cropper = null;
                        }
                        
                        // Abrir modal primeiro
                        document.getElementById('cropModal').style.display = 'flex';
                        
                        // Aguardar um pouco para o modal aparecer
                        setTimeout(() => {
                            // Definir a imagem
                            image.src = imageData;
                            
                            // Aguardar a imagem carregar completamente
                            image.onload = function() {
                                // Verificar se Cropper está disponível
                                if (typeof Cropper === 'undefined') {
                                    console.error('Cropper.js não está carregado!');
                                    alert('Erro ao carregar editor de imagens. Recarregue a página e tente novamente.');
                                    document.getElementById('cropModal').style.display = 'none';
                                    return;
                                }
                                
                                // Inicializar cropper após a imagem estar carregada
                                cropper = new Cropper(image, {
                                    aspectRatio: 1,
                                    viewMode: 0,
                                    dragMode: 'move',
                                    autoCropArea: 0.75,
                                    restore: false,
                                    guides: true,
                                    center: true,
                                    highlight: true,
                                    cropBoxMovable: true,
                                    cropBoxResizable: true,
                                    toggleDragModeOnDblclick: false,
                                    minContainerWidth: 200,
                                    minContainerHeight: 200,
                                    responsive: true,
                                    checkOrientation: true,
                                    ready: function() {
                                        console.log('Cropper pronto!');
                                        updateZoomDisplay();
                                    },
                                    zoom: function(event) {
                                        updateZoomDisplay();
                                    }
                                });
                                
                                // Resetar slider de zoom
                                document.getElementById('zoomSlider').value = 0;
                            };
                        }, 100);
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Background não precisa de crop
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const bgPreviewImg = document.getElementById('bgPreviewImg');
                        const bgPreview = document.getElementById('bgPreview');
                        const bgPlaceholder = document.getElementById('bgPlaceholder');
                        if (bgPreviewImg) bgPreviewImg.src = e.target.result;
                        if (bgPreview) bgPreview.classList.remove('hidden');
                        if (bgPlaceholder) bgPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }
            updateProgress();
        }
        
        function cancelCrop() {
            // Fechar modal (mudar display para none)
            document.getElementById('cropModal').style.display = 'none';
            
            // Destruir cropper
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            
            // Limpar imagem do modal
            const image = document.getElementById('cropImage');
            if (image) {
                image.src = '';
                image.onload = null;
            }
            
            // Resetar input de arquivo
            if (currentInput) {
                currentInput.value = '';
            }
            
            // Limpar variáveis
            currentInput = null;
            currentType = null;
            originalFile = null;
        }
        
        function applyCrop() {
            if (!cropper) {
                alert('Erro: Editor de imagem não inicializado.');
                return;
            }
            
            try {
                // Obter imagem cortada
                const canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });
                
                if (!canvas) {
                    alert('Erro ao processar a imagem. Tente novamente.');
                    return;
                }
                
                canvas.toBlob(function(blob) {
                    if (!blob) {
                        alert('Erro ao processar a imagem. Tente novamente.');
                        return;
                    }
                    
                    // Criar novo arquivo com a imagem cortada
                    const croppedFile = new File([blob], 'logo-cropped.png', {
                        type: 'image/png',
                        lastModified: Date.now()
                    });
                    
                    // Criar DataTransfer para atualizar o input
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    currentInput.files = dataTransfer.files;
                    
                    // Mostrar preview da imagem cortada
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const logoPreviewImg = document.getElementById('logoPreviewImg');
                        const logoPreview = document.getElementById('logoPreview');
                        const logoPlaceholder = document.getElementById('logoPlaceholder');
                        
                        if (logoPreviewImg) {
                            logoPreviewImg.src = e.target.result;
                        }
                        if (logoPreview) {
                            logoPreview.classList.remove('hidden');
                        }
                        if (logoPlaceholder) {
                            logoPlaceholder.classList.add('hidden');
                        }
                        
                        // Atualizar progresso
                        updateProgress();
                    };
                    reader.readAsDataURL(croppedFile);
                    
                    // Fechar modal (mudar display para none)
                    document.getElementById('cropModal').style.display = 'none';
                    
                    // Destruir cropper
                    if (cropper) {
                        cropper.destroy();
                        cropper = null;
                    }
                    
                    // Limpar imagem do modal
                    const image = document.getElementById('cropImage');
                    if (image) {
                        image.src = '';
                        image.onload = null;
                    }
                    
                    // Limpar variáveis temporárias
                    currentType = null;
                    originalFile = null;
                    
                }, 'image/png', 0.95);
            } catch (error) {
                console.error('Erro ao aplicar crop:', error);
                alert('Erro ao processar a imagem. Tente novamente.');
            }
        }
        
        // Função de Zoom
        function zoomCrop(ratio) {
            if (cropper) {
                cropper.zoom(ratio);
                updateZoomDisplay();
            }
        }
        
        // Função de Rotação
        function rotateCrop() {
            if (cropper) {
                cropper.rotate(90);
            }
        }
        
        // Função de Reset
        function resetCrop() {
            if (cropper) {
                cropper.reset();
                document.getElementById('zoomSlider').value = 0;
                updateZoomDisplay();
            }
        }
        
        // Slider de Zoom
        function zoomSliderChange(value) {
            if (cropper) {
                const currentData = cropper.getImageData();
                const zoomRatio = parseFloat(value);
                cropper.zoomTo(1 + zoomRatio);
                updateZoomDisplay();
            }
        }
        
        // Atualizar Display de Zoom
        function updateZoomDisplay() {
            if (cropper) {
                const containerData = cropper.getContainerData();
                const imageData = cropper.getImageData();
                const zoomRatio = imageData.width / imageData.naturalWidth;
                const percentage = Math.round(zoomRatio * 100);
                document.getElementById('zoomLevel').textContent = `Zoom: ${percentage}%`;
            }
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
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            
            if (progressBar) {
                progressBar.style.width = progress + '%';
            }
            
            if (progressText) {
                const fieldsText = progressText.dataset.fieldsText || 'campos preenchidos';
                progressText.textContent = `${completed}/${fields.length} ${fieldsText}`;
            }
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
                    if (input) {
                        input.files = files;
                        const type = input.id === 'logo' ? 'logo' : 'background';
                        handleFileUpload(input, type);
                    }
                }
            });
        });
        
        // Form submission - prevent double submit
        const companyForm = document.getElementById('companyForm');
        if (companyForm) {
            companyForm.addEventListener('submit', function(e) {
                const submitButtons = document.querySelectorAll('button[type="submit"], button[onclick*="submit"]');
                submitButtons.forEach(button => {
                    if (!button.disabled) {
                        const savingText = 'Salvando...';
                        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>' + savingText;
                        button.disabled = true;
                    }
                });
            });
        }
        
        // Initialize progress on page load
        updateProgress();
    </script>
@endsection
