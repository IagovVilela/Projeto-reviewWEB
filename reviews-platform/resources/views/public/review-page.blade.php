<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('public.how_was_experience') }} - {{ $company->name ?? 'Nossa Empresa' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-gradient {
            background: #667eea;
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .review-card {
            transition: all 0.3s ease;
        }
        
        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .google-button {
            background: #4285F4;
            transition: all 0.3s ease;
        }
        
        .google-button:hover {
            background: #3367d6;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(66, 133, 244, 0.3);
        }
        
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in-left {
            animation: slideInLeft 0.8s ease-out;
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        /* Logo enhancement styles */
        .company-logo {
            transition: all 0.3s ease;
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.15));
            border-radius: 20px;
        }
        
        .company-logo:hover {
            transform: scale(1.08);
            filter: drop-shadow(0 12px 24px rgba(0, 0, 0, 0.25));
        }
        
        .company-name-large {
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.4);
            letter-spacing: -0.02em;
            font-weight: 800;
        }
        
        /* Map icon clickable styles */
        .map-icon-clickable {
            transition: all 0.2s ease;
        }
        
        .map-icon-clickable:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 2px 4px rgba(59, 130, 246, 0.3));
        }
        
        .slide-in-right {
            animation: slideInRight 0.8s ease-out;
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        /* Mobile-specific styles */
        @media (max-width: 768px) {
            .hero-gradient {
                padding: 2rem 1rem;
            }
            
            .company-logo {
                max-width: 120px;
                max-height: 120px;
            }
            
            .company-name-large {
                font-size: 2.5rem;
                line-height: 1.2;
            }
            
            .floating-shapes .shape {
                display: none;
            }
            
            .review-card {
                margin: 0.5rem;
                padding: 1rem;
            }
            
            .form-input {
                font-size: 16px; /* Prevents zoom on iOS */
            }
            
            .btn-mobile {
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                min-height: 44px; /* iOS touch target */
            }
            
            .contact-info-mobile {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .contact-info-mobile .flex {
                margin-bottom: 0.5rem;
            }
        }
        
        @media (max-width: 480px) {
            .company-logo {
                max-width: 100px;
                max-height: 100px;
            }
            
            .company-name-large {
                font-size: 2rem;
            }
            
            .hero-gradient {
                padding: 1.5rem 0.5rem;
            }
            
            .review-card {
                margin: 0.25rem;
                padding: 0.75rem;
            }
        }
        
        /* Touch-friendly styles */
        .touch-target {
            min-height: 44px;
            min-width: 44px;
        }
        
        /* Prevent zoom on input focus (iOS) */
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            font-size: 16px;
        }
        
        /* Smooth scrolling for mobile */
        html {
            scroll-behavior: smooth;
        }
        
        /* Mobile navigation improvements */
        @media (max-width: 768px) {
            .mobile-nav {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                background: white;
                border-top: 1px solid #e5e7eb;
                padding: 0.5rem;
                z-index: 50;
            }
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">
    <!-- Success Message -->
    @if(session('success'))
    <div class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg animate-slide-in">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3 text-xl"></i>
            <div>
                <h4 class="font-semibold">Sucesso!</h4>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif
    <!-- Language Selector -->
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg p-2">
            <div class="flex items-center space-x-2">
                <a href="?lang=pt_BR" class="px-3 py-2 rounded {{ app()->getLocale() === 'pt_BR' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition-colors text-sm font-medium">
                    PT
                </a>
                <a href="?lang=en_US" class="px-3 py-2 rounded {{ app()->getLocale() === 'en_US' ? 'bg-blue-500 text-white' : 'text-gray-600 hover:bg-gray-100' }} transition-colors text-sm font-medium">
                    EN
                </a>
            </div>
        </div>
    </div>
    
    <!-- Hero Section -->
    <div class="relative overflow-hidden hero-gradient" @if($company->background_image_url) style="background-image: url('{{ $company->background_image_url }}'); background-size: cover; background-position: center;" @endif>
        <!-- Overlay para melhorar legibilidade quando há imagem de fundo -->
        @if($company->background_image_url)
        <div class="absolute inset-0 bg-black/30"></div>
        @endif
        
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="relative z-10 px-4 py-8 sm:py-16 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
<<<<<<< HEAD
                <!-- Company Logo/Name Section -->
                <div class="mb-6 sm:mb-8 fade-in">
                    @if(isset($company->logo) && $company->logo)
                        <!-- Logo exists - show much larger logo -->
                        <div class="inline-flex items-center justify-center w-32 h-32 sm:w-48 sm:h-48 bg-white/20 backdrop-blur-sm rounded-3xl mb-4 sm:mb-8 shadow-lg">
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="w-24 h-24 sm:w-40 sm:h-40 object-contain company-logo">
                        </div>
                        <!-- Company Name below logo -->
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4 sm:mb-8 fade-in company-name-large">
                            {{ $company->name ?? 'Nossa Empresa' }}
                        </h1>
                    @else
                        <!-- No logo - show only company name, much larger -->
                        <h1 class="text-4xl sm:text-6xl md:text-8xl font-bold text-white mb-4 sm:mb-8 fade-in company-name-large">
                            {{ $company->name ?? 'Nossa Empresa' }}
                        </h1>
                    @endif
=======
                <!-- Company Logo -->
                <div class="mb-8 fade-in">
                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 backdrop-blur-sm rounded-2xl mb-6">
                        @if(isset($company->logo) && $company->logo)
                            <div class="image-placeholder w-16 h-16 bg-transparent">
                                <img src="{{ asset('storage/' . $company->logo) }}" 
                                     alt="{{ $company->name }}" 
                                     loading="lazy"
                                     class="w-16 h-16 object-contain"
                                     onload="this.parentElement.classList.add('loaded')">
                                <div class="placeholder-shimmer"></div>
                            </div>
                        @else
                            <i class="fas fa-building text-white text-3xl"></i>
                        @endif
                    </div>
>>>>>>> Perfil-gerenciamento-usuarios
                </div>
                
                <!-- Subtitle -->
<<<<<<< HEAD
                <p class="text-lg sm:text-xl md:text-2xl text-blue-100 mb-6 sm:mb-8 fade-in px-4">
                    Sua opinião é muito importante para nós!
=======
                <p class="text-xl md:text-2xl text-blue-100 mb-8 fade-in">
                    {{ __('public.your_opinion_matters') }}
>>>>>>> Perfil-gerenciamento-usuarios
                </p>
                
                <!-- Rating Info -->
                <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 mb-8 fade-in">
                    <div class="flex items-center justify-center space-x-2 mb-4">
                        <i class="fas fa-star text-yellow-400 text-2xl"></i>
                        <i class="fas fa-star text-yellow-400 text-2xl"></i>
                        <i class="fas fa-star text-yellow-400 text-2xl"></i>
                        <i class="fas fa-star text-yellow-400 text-2xl"></i>
                        <i class="fas fa-star text-yellow-400 text-2xl"></i>
                    </div>
                    <p class="text-white text-lg">
                        {{ __('public.reviews_considered_positive', ['score' => $company->positive_score ?? 4]) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-16">
        <!-- Review Form -->
        <div class="max-w-2xl mx-auto mb-16">
<<<<<<< HEAD
            <div class="bg-white rounded-2xl p-4 sm:p-8 shadow-lg border border-gray-100 fade-in">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Como foi sua experiência?</h2>
=======
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 fade-in">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">{{ __('public.how_was_experience') }}</h2>
>>>>>>> Perfil-gerenciamento-usuarios
                
                <!-- Rating Stars -->
                <div class="text-center mb-6 sm:mb-8">
                    <div class="flex justify-center space-x-1 sm:space-x-2 mb-4" id="ratingStars">
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="1"></i>
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="2"></i>
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="3"></i>
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="4"></i>
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="5"></i>
                    </div>
<<<<<<< HEAD
                    <p class="text-sm sm:text-base text-gray-600 px-4" id="ratingText">Toque nas estrelas para avaliar</p>
=======
                    <p class="text-gray-600" id="ratingText">{{ __('public.touch_stars_to_rate') }}</p>
>>>>>>> Perfil-gerenciamento-usuarios
                </div>
                
                <!-- Review Form -->
                <form id="reviewForm" class="space-y-4 sm:space-y-6">
                    @csrf
                    <input type="hidden" id="rating" name="rating" value="">
                    <input type="hidden" id="company_token" name="company_token" value="{{ $token }}">
                    
                    <!-- WhatsApp -->
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fab fa-whatsapp text-green-500 mr-2"></i>
                            {{ __('public.whatsapp_number') }}
                        </label>
                        <input 
                            type="tel" 
                            id="whatsapp" 
                            name="whatsapp"
                            required
<<<<<<< HEAD
                            class="w-full px-3 sm:px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent form-input"
                            placeholder="(11) 99999-9999"
                            maxlength="15"
                            oninput="formatPhoneNumber(this)"
=======
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="{{ __('public.whatsapp_placeholder') }}"
>>>>>>> Perfil-gerenciamento-usuarios
                        >
                        <p class="text-xs text-gray-500 mt-1">{{ __('public.whatsapp_hint') }}</p>
                    </div>
                    
                    <!-- Comment -->
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-comment text-blue-500 mr-2"></i>
                            {{ __('public.comment_optional') }}
                        </label>
                        <textarea 
                            id="comment" 
                            name="comment"
<<<<<<< HEAD
                            rows="3"
                            class="w-full px-3 sm:px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent form-input resize-none"
                            placeholder="Conte-nos mais sobre sua experiência..."
=======
                            rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                            placeholder="{{ __('public.comment_placeholder') }}"
>>>>>>> Perfil-gerenciamento-usuarios
                        ></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        id="submitBtn"
                        disabled
<<<<<<< HEAD
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 sm:py-4 rounded-xl font-semibold text-base sm:text-lg disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 btn-mobile touch-target"
=======
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white py-4 rounded-xl font-semibold text-lg disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300"
>>>>>>> Perfil-gerenciamento-usuarios
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        {{ __('public.send_review') }}
                    </button>
                </form>
                
                <!-- Loading State -->
                <div id="loadingState" class="hidden text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                        <i class="fas fa-spinner fa-spin text-blue-600 text-2xl"></i>
                    </div>
                    <p class="text-gray-600">{{ __('public.processing_review') }}</p>
                </div>
                
                <!-- Success State -->
                <div id="successState" class="hidden text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <i class="fas fa-check text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ __('public.review_sent') }}</h3>
                    <p class="text-gray-600 mb-4">{{ __('public.thanks_for_feedback') }}</p>
                    <div id="nextAction" class="mt-6">
                        <!-- Content will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Company Info -->
<<<<<<< HEAD
        <div class="bg-white rounded-2xl p-4 sm:p-8 shadow-lg border border-gray-100 fade-in">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Sobre Nós</h2>
=======
        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 fade-in">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">{{ __('public.about_us') }}</h2>
>>>>>>> Perfil-gerenciamento-usuarios
            
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <!-- Contact Info -->
                <div>
<<<<<<< HEAD
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 sm:mb-4">Informações de Contato</h3>
                    <div class="space-y-3 contact-info-mobile">
=======
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">{{ __('public.contact_information') }}</h3>
                    <div class="space-y-3">
>>>>>>> Perfil-gerenciamento-usuarios
                        @if(isset($company->contact_number) && $company->contact_number)
                        <div class="flex items-center">
                            <i class="fas fa-phone text-blue-500 mr-3"></i>
                            <span class="text-gray-600 text-sm sm:text-base">{{ $company->contact_number }}</span>
                        </div>
                        @endif
                        
                        @if(isset($company->business_website) && $company->business_website)
                        <div class="flex items-center">
                            <i class="fas fa-globe text-blue-500 mr-3"></i>
                            <a href="{{ $company->business_website }}" target="_blank" class="text-blue-600 hover:underline text-sm sm:text-base break-all">
                                {{ $company->business_website }}
                            </a>
                        </div>
                        @endif
                        
                        @if(isset($company->business_address) && $company->business_address)
                        <div class="flex items-start">
<<<<<<< HEAD
                            <a href="https://www.google.com/maps/search/{{ urlencode($company->business_address) }}" 
                               target="_blank" 
                               class="flex items-start hover:opacity-80 transition-opacity duration-200"
                               title="Ver no Google Maps">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-3 mt-1 cursor-pointer hover:text-blue-600 transition-colors duration-200 map-icon-clickable"></i>
                            </a>
                            <span class="text-gray-600 text-sm sm:text-base">{{ $company->business_address }}</span>
=======
                            <i class="fas fa-map-marker-alt text-blue-500 mr-3 mt-1"></i>
                            @if($company->google_maps_url)
                                <a href="{{ $company->google_maps_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline transition-colors">
                                    {{ $company->business_address }}
                                </a>
                            @else
                                <span class="text-gray-600">{{ $company->business_address }}</span>
                            @endif
>>>>>>> Perfil-gerenciamento-usuarios
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Google Reviews -->
                <div>
<<<<<<< HEAD
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 sm:mb-4">Nossas Avaliações</h3>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 sm:p-6">
                            <div class="flex items-center mb-3 sm:mb-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-xl flex items-center justify-center mr-3 sm:mr-4 shadow-sm">
                                    <img src="/assets/images/platforms/google.png" alt="Google" class="w-6 h-6 sm:w-8 sm:h-8 object-contain">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Google My Business</h4>
                                    <p class="text-xs sm:text-sm text-gray-600">Avaliações verificadas</p>
=======
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">{{ __('public.our_reviews') }}</h3>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mr-4 shadow-sm">
                                    <div class="image-placeholder w-8 h-8 bg-transparent">
                                        <img src="/assets/images/platforms/google.png" 
                                             alt="Google" 
                                             loading="lazy"
                                             class="w-8 h-8 object-contain"
                                             onload="this.parentElement.classList.add('loaded')">
                                        <div class="placeholder-shimmer"></div>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ __('public.google_my_business') }}</h4>
                                    <p class="text-sm text-gray-600">{{ __('public.verified_reviews') }}</p>
>>>>>>> Perfil-gerenciamento-usuarios
                                </div>
                            </div>
                            <a href="{{ $company->google_business_url ?? '#' }}" 
                               target="_blank"
<<<<<<< HEAD
                               class="text-blue-600 hover:text-blue-800 font-medium text-sm sm:text-base">
                                Ver todas as avaliações →
=======
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ __('public.view_all_reviews') }} →
>>>>>>> Perfil-gerenciamento-usuarios
                            </a>
                        </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
<<<<<<< HEAD
        <div class="text-center mt-8 sm:mt-16 fade-in">
            <p class="text-gray-500 text-xs sm:text-sm">
                Powered by Reviews Platform
=======
        <div class="text-center mt-16 fade-in">
            <p class="text-gray-500 text-sm">
                {{ __('public.powered_by') }}
>>>>>>> Perfil-gerenciamento-usuarios
            </p>
        </div>
    </div>
    
    <script>
<<<<<<< HEAD
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
=======
        // Translations for public review page
        const translations = {
            pt_BR: {
                rating_1: 'Péssimo',
                rating_2: 'Ruim',
                rating_3: 'Regular',
                rating_4: 'Bom',
                rating_5: 'Excelente',
                redirecting_to_google: 'Redirecionando para o Google...',
                redirecting_google_desc: 'Você será redirecionado para deixar sua avaliação pública no Google My Business.',
                redirecting_in_seconds: 'Redirecionando em 3 segundos...',
                thanks_for_negative_feedback: 'Obrigado pelo feedback!',
                how_can_we_improve: 'O que podemos melhorar?',
                feedback_placeholder: 'Conte-nos o que aconteceu para que possamos melhorar nosso atendimento...',
                how_prefer_contact: 'Como você prefere ser contatado?',
                contact_whatsapp: 'WhatsApp (mesmo número informado)',
                contact_email: 'E-mail',
                contact_phone: 'Telefone',
                contact_no: 'Não desejo ser contatado',
                contact_detail_label: 'E-mail ou Telefone',
                contact_detail_email_placeholder: 'Digite seu e-mail',
                contact_detail_phone_placeholder: '(11) 99999-9999',
                contact_detail_required: 'Este campo será obrigatório',
                send_private_feedback: 'Enviar Feedback Privado',
                skip: 'Pular',
                private_feedback_sent: 'Feedback enviado!',
                private_feedback_sent_desc: 'Obrigado pelo seu feedback detalhado. Nossa equipe entrará em contato em breve.',
                private_feedback_success: 'Feedback privado enviado com sucesso!',
                review_registered: 'Sua avaliação foi registrada. Entraremos em contato se necessário.',
                review_registered_success: 'Avaliação registrada com sucesso!',
                please_tell_us: 'Por favor, conte-nos o que podemos melhorar.',
                please_enter_email: 'Por favor, informe um e-mail de contato.',
                please_enter_phone: 'Por favor, informe um telefone de contato.',
                error_sending_feedback: 'Erro ao enviar feedback. Tente novamente.'
            },
            en_US: {
                rating_1: 'Terrible',
                rating_2: 'Poor',
                rating_3: 'Average',
                rating_4: 'Good',
                rating_5: 'Excellent',
                redirecting_to_google: 'Redirecting to Google...',
                redirecting_google_desc: 'You will be redirected to leave your public review on Google My Business.',
                redirecting_in_seconds: 'Redirecting in 3 seconds...',
                thanks_for_negative_feedback: 'Thanks for the feedback!',
                how_can_we_improve: 'How can we improve?',
                feedback_placeholder: 'Tell us what happened so we can improve our service...',
                how_prefer_contact: 'How would you like to be contacted?',
                contact_whatsapp: 'WhatsApp (same number provided)',
                contact_email: 'E-mail',
                contact_phone: 'Phone',
                contact_no: 'I do not wish to be contacted',
                contact_detail_label: 'Email or Phone',
                contact_detail_email_placeholder: 'Enter your email',
                contact_detail_phone_placeholder: '(11) 99999-9999',
                contact_detail_required: 'This field will be required',
                send_private_feedback: 'Send Private Feedback',
                skip: 'Skip',
                private_feedback_sent: 'Feedback sent!',
                private_feedback_sent_desc: 'Thank you for your detailed feedback. Our team will contact you shortly.',
                private_feedback_success: 'Private feedback sent successfully!',
                review_registered: 'Your review has been registered. We will contact you if necessary.',
                review_registered_success: 'Review registered successfully!',
                please_tell_us: 'Please tell us how we can improve.',
                please_enter_email: 'Please provide a contact email.',
                please_enter_phone: 'Please provide a contact phone.',
                error_sending_feedback: 'Error sending feedback. Please try again.'
            }
        };
        
        const currentLang = '{{ app()->getLocale() }}';
        const t = translations[currentLang] || translations.pt_BR;
>>>>>>> Perfil-gerenciamento-usuarios
        
        // Review System
        class ReviewSystem {
            constructor() {
                this.selectedRating = 0;
                this.companyData = @json($company);
                this.token = '{{ $token }}';
                this.positiveThreshold = this.companyData.positive_score || 4;
                this.init();
            }
            
            init() {
                this.bindStarEvents();
                this.bindFormEvents();
            }
            
            bindStarEvents() {
                const stars = document.querySelectorAll('#ratingStars i');
                
                stars.forEach((star, index) => {
                    // Click event
                    star.addEventListener('click', () => {
                        this.selectRating(index + 1);
                    });
                    
                    // Touch event for mobile
                    star.addEventListener('touchend', (e) => {
                        e.preventDefault();
                        this.selectRating(index + 1);
                    });
                    
                    // Hover effects (desktop only)
                    star.addEventListener('mouseenter', () => {
                        if (window.innerWidth > 768) {
                            this.highlightStars(index + 1);
                        }
                    });
                });
                
                // Reset hover on mouse leave
                document.getElementById('ratingStars').addEventListener('mouseleave', () => {
                    if (window.innerWidth > 768) {
                        this.highlightStars(this.selectedRating);
                    }
                });
            }
            
            selectRating(rating) {
                this.selectedRating = rating;
                this.highlightStars(rating);
                this.updateRatingText(rating);
                this.updateSubmitButton();
                document.getElementById('rating').value = rating;
            }
            
            highlightStars(rating) {
                const stars = document.querySelectorAll('#ratingStars i');
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            }
            
            updateRatingText(rating) {
                const texts = {
                    1: t.rating_1,
                    2: t.rating_2,
                    3: t.rating_3,
                    4: t.rating_4,
                    5: t.rating_5
                };
                document.getElementById('ratingText').textContent = texts[rating];
            }
            
            updateSubmitButton() {
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = this.selectedRating === 0;
            }
            
            bindFormEvents() {
                document.getElementById('reviewForm').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.submitReview();
                });
            }
            
            async submitReview() {
                const formData = new FormData(document.getElementById('reviewForm'));
                
                // Show loading state
                this.showLoadingState();
                
                try {
                    const response = await fetch('/api/reviews', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        // Store current review ID for private feedback
                        window.currentReviewId = result.data.review_id;
                        this.showSuccessState(result);
                    } else {
                        this.showErrorState(result.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    this.showErrorState('Erro ao enviar avaliação. Tente novamente.');
                }
            }
            
            showLoadingState() {
                document.getElementById('reviewForm').classList.add('hidden');
                document.getElementById('loadingState').classList.remove('hidden');
            }
            
            showSuccessState(result) {
                document.getElementById('loadingState').classList.add('hidden');
                document.getElementById('successState').classList.remove('hidden');
                
                console.log('Result from API:', result);
                
                // Determine next action based on rating
                const nextAction = document.getElementById('nextAction');
                
                // Check if result has data property, otherwise use the old logic
                const isPositive = result.data ? result.data.is_positive : (this.selectedRating >= this.positiveThreshold);
                const googleUrl = result.data ? result.data.google_business_url : this.companyData.google_business_url;
                const negativeEmail = result.data ? result.data.negative_email : this.companyData.negative_email;
                
                if (isPositive) {
                    // Positive review - redirect to Google
                    nextAction.innerHTML = `
                        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-green-800 mb-2">${t.redirecting_to_google}</h4>
                            <p class="text-green-600 mb-4">${t.redirecting_google_desc}</p>
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-spinner fa-spin text-green-600"></i>
                                <span class="text-green-600">${t.redirecting_in_seconds}</span>
                            </div>
                        </div>
                    `;
                    
                    // Redirect to Google after 3 seconds
                    setTimeout(() => {
                        if (googleUrl) {
                            window.open(googleUrl, '_blank');
                        }
                    }, 3000);
                } else {
                    // Negative review - show private feedback form
                    nextAction.innerHTML = `
                        <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-red-800 mb-2">${t.thanks_for_negative_feedback}</h4>
                            <p class="text-red-600 mb-4">Sua avaliação foi registrada. Para nos ajudar a melhorar, você pode nos contar mais detalhes:</p>
                            
                            <form id="privateFeedbackForm" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">${t.how_can_we_improve}</label>
                                    <textarea 
                                        id="privateFeedback" 
                                        name="feedback" 
                                        rows="4" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                        placeholder="${t.feedback_placeholder}"
                                    ></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">${t.how_prefer_contact}</label>
                                    <select 
                                        id="contactPreference" 
                                        name="contact_preference"
                                        onchange="toggleContactField(this)"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                    >
                                        <option value="whatsapp">${t.contact_whatsapp}</option>
                                        <option value="email">${t.contact_email}</option>
                                        <option value="phone">${t.contact_phone}</option>
                                        <option value="no_contact">${t.contact_no}</option>
                                    </select>
                                </div>
                                
                                <!-- Campo dinâmico para email/telefone -->
                                <div id="contactDetailField" class="hidden">
                                    <label id="contactDetailLabel" class="block text-sm font-medium text-gray-700 mb-2">
                                        ${t.contact_detail_label}
                                    </label>
                                    <input 
                                        type="text" 
                                        id="contactDetail" 
                                        name="contact_detail"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                        placeholder="Digite seu e-mail ou telefone"
                                    />
                                    <p class="text-xs text-gray-500 mt-1">${t.contact_detail_required}</p>
                                </div>
                                
                                <div class="flex space-x-3">
                                    <button 
                                        type="button" 
                                        onclick="submitPrivateFeedback(event)" 
                                        class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition-colors"
                                    >
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        ${t.send_private_feedback}
                                    </button>
                                    <button 
                                        type="button" 
                                        onclick="skipPrivateFeedback()" 
                                        class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors"
                                    >
                                        ${t.skip}
                                    </button>
                                </div>
                            </form>
                        </div>
                    `;
                }
            }
            
            showErrorState(message) {
                document.getElementById('loadingState').classList.add('hidden');
                document.getElementById('reviewForm').classList.remove('hidden');
                
                // Show error notification
                this.showNotification(message, 'error');
            }
            
            showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.textContent = message;
                
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
                    background: type === 'error' ? '#ef4444' : '#10b981',
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
                }, 5000);
            }
        }
        
        // Global functions for private feedback
        async function submitPrivateFeedback(event) {
            const feedback = document.getElementById('privateFeedback').value;
            const contactPreference = document.getElementById('contactPreference').value;
            const contactDetailField = document.getElementById('contactDetailField');
            const contactDetail = document.getElementById('contactDetail').value;
            
            if (!feedback.trim()) {
                alert(t.please_tell_us);
                return;
            }
            
            // Validar campo de contato detalhado se necessário
            if (contactPreference === 'email' || contactPreference === 'phone') {
                if (!contactDetail.trim()) {
                    alert(contactPreference === 'email' ? t.please_enter_email : t.please_enter_phone);
                    return;
                }
            }
            
            try {
                // Show loading - safely get button
                const button = event && event.target ? event.target : document.querySelector('#privateFeedbackForm button[type="button"]');
                if (!button) return;
                
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Enviando...';
                button.disabled = true;
                
                // Send private feedback
                const response = await fetch('/api/reviews/private-feedback', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        review_id: window.currentReviewId,
                        feedback: feedback,
                        contact_preference: contactPreference,
                        contact_detail: contactDetail
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Show success message
                    document.getElementById('nextAction').innerHTML = `
                        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-green-800 mb-2">${t.private_feedback_sent}</h4>
                            <p class="text-green-600 mb-4">${t.private_feedback_sent_desc}</p>
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span class="text-green-600">${t.private_feedback_success}</span>
                            </div>
                        </div>
                    `;
                } else {
                    alert(t.error_sending_feedback);
                }
            } catch (error) {
                console.error('Erro ao enviar feedback:', error);
                alert('Erro ao enviar feedback. Tente novamente.');
            } finally {
                // Restore button safely
                if (button && originalText) {
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            }
        }
        
        function skipPrivateFeedback() {
            document.getElementById('nextAction').innerHTML = `
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ __('public.thanks_for_feedback') }}</h4>
                    <p class="text-gray-600 mb-4">${t.review_registered}</p>
                    <div class="flex items-center justify-center space-x-2">
                        <i class="fas fa-check-circle text-gray-600"></i>
                        <span class="text-gray-600">${t.review_registered_success}</span>
                    </div>
                </div>
            `;
        }
        
        // Função para mostrar/ocultar campo de contato detalhado
        function toggleContactField(select) {
            const contactField = document.getElementById('contactDetailField');
            const contactInput = document.getElementById('contactDetail');
            const contactLabel = document.getElementById('contactDetailLabel');
            
            const value = select.value;
            
            if (value === 'email' || value === 'phone') {
                // Mostrar campo
                contactField.classList.remove('hidden');
                
                // Atualizar label baseado na seleção
                if (value === 'email') {
                    contactLabel.textContent = t.contact_email;
                    contactInput.type = 'email';
                    contactInput.placeholder = t.contact_detail_email_placeholder;
                    contactInput.required = true;
                } else if (value === 'phone') {
                    contactLabel.textContent = t.contact_phone;
                    contactInput.type = 'tel';
                    contactInput.placeholder = t.contact_detail_phone_placeholder;
                    contactInput.required = true;
                }
                
                // Limpar e focar no campo
                contactInput.value = '';
                contactInput.focus();
            } else {
                // Ocultar campo
                contactField.classList.add('hidden');
                contactInput.required = false;
                contactInput.value = '';
            }
        }
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new ReviewSystem();
            
            // Formatação de telefone WhatsApp
            const whatsappInput = document.getElementById('whatsapp');
            if (whatsappInput) {
                whatsappInput.addEventListener('input', function(e) {
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
    </script>
</body>
</html>
