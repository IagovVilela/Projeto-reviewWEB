<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Avalie-nos - {{ $company->name ?? 'Nossa Empresa' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #4285F4 0%, #34A853 100%);
            transition: all 0.3s ease;
        }
        
        .google-button:hover {
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
    <!-- Hero Section -->
    <div class="relative overflow-hidden hero-gradient" @if(isset($company->background_image) && $company->background_image) style="background-image: url('{{ asset('storage/' . $company->background_image) }}'); background-size: cover; background-position: center;" @endif>
        <!-- Overlay para melhorar legibilidade quando há imagem de fundo -->
        @if(isset($company->background_image) && $company->background_image)
        <div class="absolute inset-0 bg-black/30"></div>
        @endif
        
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="relative z-10 px-4 py-8 sm:py-16 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
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
                </div>
                
                <!-- Subtitle -->
                <p class="text-lg sm:text-xl md:text-2xl text-blue-100 mb-6 sm:mb-8 fade-in px-4">
                    Sua opinião é muito importante para nós!
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
                        Avaliações {{ $company->positive_score ?? 4 }}+ são consideradas positivas
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-16">
        <!-- Review Form -->
        <div class="max-w-2xl mx-auto mb-16">
            <div class="bg-white rounded-2xl p-4 sm:p-8 shadow-lg border border-gray-100 fade-in">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Como foi sua experiência?</h2>
                
                <!-- Rating Stars -->
                <div class="text-center mb-6 sm:mb-8">
                    <div class="flex justify-center space-x-1 sm:space-x-2 mb-4" id="ratingStars">
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="1"></i>
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="2"></i>
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="3"></i>
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="4"></i>
                        <i class="fas fa-star text-3xl sm:text-4xl text-gray-300 cursor-pointer hover:text-yellow-400 transition-colors touch-target" data-rating="5"></i>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 px-4" id="ratingText">Toque nas estrelas para avaliar</p>
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
                            Número do WhatsApp
                        </label>
                        <input 
                            type="tel" 
                            id="whatsapp" 
                            name="whatsapp"
                            required
                            class="w-full px-3 sm:px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent form-input"
                            placeholder="(11) 99999-9999"
                            maxlength="15"
                            oninput="formatPhoneNumber(this)"
                        >
                        <p class="text-xs text-gray-500 mt-1">Usado apenas para contato interno, não será divulgado</p>
                    </div>
                    
                    <!-- Comment -->
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-comment text-blue-500 mr-2"></i>
                            Comentário (opcional)
                        </label>
                        <textarea 
                            id="comment" 
                            name="comment"
                            rows="3"
                            class="w-full px-3 sm:px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent form-input resize-none"
                            placeholder="Conte-nos mais sobre sua experiência..."
                        ></textarea>
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        id="submitBtn"
                        disabled
                        class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 sm:py-4 rounded-xl font-semibold text-base sm:text-lg disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-300 btn-mobile touch-target"
                    >
                        <i class="fas fa-paper-plane mr-2"></i>
                        Enviar Avaliação
                    </button>
                </form>
                
                <!-- Loading State -->
                <div id="loadingState" class="hidden text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                        <i class="fas fa-spinner fa-spin text-blue-600 text-2xl"></i>
                    </div>
                    <p class="text-gray-600">Processando sua avaliação...</p>
                </div>
                
                <!-- Success State -->
                <div id="successState" class="hidden text-center py-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                        <i class="fas fa-check text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Avaliação Enviada!</h3>
                    <p class="text-gray-600 mb-4">Obrigado pelo seu feedback</p>
                    <div id="nextAction" class="mt-6">
                        <!-- Content will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Company Info -->
        <div class="bg-white rounded-2xl p-4 sm:p-8 shadow-lg border border-gray-100 fade-in">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6 text-center">Sobre Nós</h2>
            
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <!-- Contact Info -->
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 sm:mb-4">Informações de Contato</h3>
                    <div class="space-y-3 contact-info-mobile">
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
                            <a href="https://www.google.com/maps/search/{{ urlencode($company->business_address) }}" 
                               target="_blank" 
                               class="flex items-start hover:opacity-80 transition-opacity duration-200"
                               title="Ver no Google Maps">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-3 mt-1 cursor-pointer hover:text-blue-600 transition-colors duration-200 map-icon-clickable"></i>
                            </a>
                            <span class="text-gray-600 text-sm sm:text-base">{{ $company->business_address }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Google Reviews -->
                <div>
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 sm:mb-4">Nossas Avaliações</h3>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4 sm:p-6">
                            <div class="flex items-center mb-3 sm:mb-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-xl flex items-center justify-center mr-3 sm:mr-4 shadow-sm">
                                    <img src="/assets/images/platforms/google.png" alt="Google" class="w-6 h-6 sm:w-8 sm:h-8 object-contain">
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Google My Business</h4>
                                    <p class="text-xs sm:text-sm text-gray-600">Avaliações verificadas</p>
                                </div>
                            </div>
                            <a href="{{ $company->google_business_url ?? '#' }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 font-medium text-sm sm:text-base">
                                Ver todas as avaliações →
                            </a>
                        </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="text-center mt-8 sm:mt-16 fade-in">
            <p class="text-gray-500 text-xs sm:text-sm">
                Powered by Reviews Platform
            </p>
        </div>
    </div>
    
    <script>
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
                    1: 'Péssimo',
                    2: 'Ruim',
                    3: 'Regular',
                    4: 'Bom',
                    5: 'Excelente'
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
                            <h4 class="text-lg font-semibold text-green-800 mb-2">Redirecionando para o Google...</h4>
                            <p class="text-green-600 mb-4">Você será redirecionado para deixar sua avaliação pública no Google My Business.</p>
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-spinner fa-spin text-green-600"></i>
                                <span class="text-green-600">Redirecionando em 3 segundos...</span>
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
                            <h4 class="text-lg font-semibold text-red-800 mb-2">Obrigado pelo feedback!</h4>
                            <p class="text-red-600 mb-4">Sua avaliação foi registrada. Para nos ajudar a melhorar, você pode nos contar mais detalhes:</p>
                            
                            <form id="privateFeedbackForm" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">O que podemos melhorar?</label>
                                    <textarea 
                                        id="privateFeedback" 
                                        name="feedback" 
                                        rows="4" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                        placeholder="Conte-nos o que aconteceu para que possamos melhorar nosso atendimento..."
                                    ></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Como você prefere ser contatado?</label>
                                    <select 
                                        id="contactPreference" 
                                        name="contact_preference"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                    >
                                        <option value="whatsapp">WhatsApp (mesmo número informado)</option>
                                        <option value="email">E-mail</option>
                                        <option value="phone">Telefone</option>
                                        <option value="no_contact">Não desejo ser contatado</option>
                                    </select>
                                </div>
                                
                                <div class="flex space-x-3">
                                    <button 
                                        type="button" 
                                        onclick="submitPrivateFeedback()" 
                                        class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 transition-colors"
                                    >
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Enviar Feedback Privado
                                    </button>
                                    <button 
                                        type="button" 
                                        onclick="skipPrivateFeedback()" 
                                        class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors"
                                    >
                                        Pular
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
        async function submitPrivateFeedback() {
            const feedback = document.getElementById('privateFeedback').value;
            const contactPreference = document.getElementById('contactPreference').value;
            
            if (!feedback.trim()) {
                alert('Por favor, conte-nos o que podemos melhorar.');
                return;
            }
            
            try {
                // Show loading
                const button = event.target;
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
                        contact_preference: contactPreference
                    })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Show success message
                    document.getElementById('nextAction').innerHTML = `
                        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-green-800 mb-2">Feedback enviado!</h4>
                            <p class="text-green-600 mb-4">Obrigado pelo seu feedback detalhado. Nossa equipe entrará em contato em breve.</p>
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-check-circle text-green-600"></i>
                                <span class="text-green-600">Feedback privado enviado com sucesso!</span>
                            </div>
                        </div>
                    `;
                } else {
                    alert('Erro ao enviar feedback. Tente novamente.');
                }
            } catch (error) {
                console.error('Erro ao enviar feedback:', error);
                alert('Erro ao enviar feedback. Tente novamente.');
            } finally {
                // Restore button
                button.innerHTML = originalText;
                button.disabled = false;
            }
        }
        
        function skipPrivateFeedback() {
            document.getElementById('nextAction').innerHTML = `
                <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Obrigado!</h4>
                    <p class="text-gray-600 mb-4">Sua avaliação foi registrada. Entraremos em contato se necessário.</p>
                    <div class="flex items-center justify-center space-x-2">
                        <i class="fas fa-check-circle text-gray-600"></i>
                        <span class="text-gray-600">Avaliação registrada com sucesso!</span>
                    </div>
                </div>
            `;
        }
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new ReviewSystem();
        });
    </script>
</body>
</html>
