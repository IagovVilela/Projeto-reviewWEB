<<<<<<< HEAD
<!DOCTYPE html> 
<html lang="pt-BR"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Dashboard - Reviews Platform</title> 
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .logo-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        }
        
        .icon-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        }
        
        /* Logout button styles */
        .logout-button {
            background: none;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
        }
        
        .logout-button:hover {
            background-color: rgba(139, 92, 246, 0.1);
            color: #8b5cf6;
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
                <a href="/dashboard" class="nav-item active flex items-center px-3 py-2 rounded-lg text-sm font-medium">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    Dashboard
                </a>
                <a href="/companies" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
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
                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="logout-button nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 w-full text-left">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        Sair
                    </button>
                </form>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">DASHBOARD</h1>
                    
                    <div class="flex items-center space-x-4">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-user mr-2"></i>
                            Administrador
                        </div>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="logout-button text-gray-600 hover:text-gray-800 flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Sair
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
=======
@extends('layouts.admin')

@section('title', 'Dashboard - Reviews Platform')

@section('page-title', __('dashboard.title'))
@section('page-description', __('dashboard.overview'))

@section('content')
    <!-- Alerta de Avaliações Negativas -->
    @if(isset($negativeCount) && $negativeCount > 0)
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg flex items-center justify-between fade-in animate-pulse">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl mr-4"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-red-800">
                    {{ __('dashboard.attention_required') }}
                </h3>
                <p class="text-red-600">
                    {{ __('dashboard.negative_reviews_pending', ['count' => $negativeCount]) }}
                </p>
            </div>
        </div>
        <div>
            <a href="/reviews?filter=negative" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors flex items-center">
                <i class="fas fa-eye mr-2"></i>
                {{ __('dashboard.view_negative_reviews') }}
            </a>
        </div>
    </div>
    @endif
>>>>>>> Perfil-gerenciamento-usuarios
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Submissions Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="far fa-star text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.total_reviews') }}</h3>
                            @if(isset($negativeCount) && $negativeCount > 0)
                            <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full flex items-center animate-pulse">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                {{ $negativeCount }}
                            </span>
                            @endif
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.submissions') }}</p>
                    </div>
                    
                    <!-- Store Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4 shimmer">
                                <i class="fas fa-shopping-cart text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.store') }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.store_desc') }}</p>
                    </div>
                    
                    <!-- Resources Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4 shimmer">
                                <i class="fas fa-file-alt text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.resources') }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.resources_desc') }}</p>
                    </div>
                    
                    <!-- Create Business Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4 shimmer">
                                <i class="fas fa-th text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.create_business') }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.create_business_desc') }}</p>
                    </div>
                    
                    <!-- Subscription Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4 shimmer">
                                <i class="fas fa-sliders-h text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.subscription') }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.subscription_desc') }}</p>
                    </div>
                    
                    <!-- Billing Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4 shimmer">
                                <i class="far fa-credit-card text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.billing') }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.billing_desc') }}</p>
                    </div>
                    
                    <!-- Invoices Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4 shimmer">
                                <i class="fas fa-file-download text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.invoices') }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.invoices_desc') }}</p>
                    </div>
                    
                    <!-- Support Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4 shimmer">
                                <i class="fas fa-life-ring text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.support') }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.support_desc') }}</p>
                    </div>
                    
                    <!-- Profile Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-user text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.profile') }}</h3>
                        </div>
                        <p class="text-gray-600 text-sm">{{ __('dashboard.profile_desc') }}</p>
                    </div>
                </div>
                
                <!-- Additional Cards Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    <!-- FAQs Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer stagger-item">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4 shimmer">
                                <i class="fas fa-question-circle text-white text-lg"></i>
                            </div> 
                            <h3 class="text-lg font-semibold text-gray-800">{{ __('dashboard.faqs') }}</h3>
                        </div> 
                        <p class="text-gray-600 text-sm">{{ __('dashboard.faqs_desc') }}</p>
                    </div> 
                </div>
@endsection

@section('scripts')
    <script>
        // Add click handlers for cards - safely
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.card-hover').forEach(card => {
                // Prevent interference with buttons and links inside cards
                card.addEventListener('click', function(e) {
                    // Don't navigate if clicking on a button or link
                    if (e.target.tagName === 'BUTTON' || e.target.tagName === 'A' || 
                        e.target.closest('button') || e.target.closest('a')) {
                        return;
                    }
                    
                    const titleElement = this.querySelector('h3');
                    if (!titleElement) return;
                    
                    const title = titleElement.textContent.trim();
                    
                    // Simple navigation based on card title (check for both languages)
                    const titles = [
                        {pt: 'Total de Avaliações', en: 'Total Reviews', url: '/reviews'},
                        {pt: 'Avaliações', en: 'Reviews', url: '/reviews'},
                        {pt: 'Loja', en: 'Store', url: '/store'},
                        {pt: 'Recursos', en: 'Resources', url: '/resources'},
                        {pt: 'Criar Empresa', en: 'Create Business', url: '/companies/create'},
                        {pt: 'Assinatura', en: 'Subscription', url: '/subscription'},
                        {pt: 'Cobrança', en: 'Billing', url: '/billing'},
                        {pt: 'Faturas', en: 'Invoices', url: '/invoices'},
                        {pt: 'Suporte', en: 'Support', url: '/support'},
                        {pt: 'Perfil', en: 'Profile', url: '/profile'},
                        {pt: 'FAQs', en: 'FAQs', url: '/faqs'}
                    ];
                    
                    const foundTitle = titles.find(t => t.pt === title || t.en === title);
                    if (foundTitle) {
                        window.location.href = foundTitle.url;
                        return;
                    }
                    
                    // Fallback to original switch
                    switch(title) {
                        case 'Total de Avaliações':
                        case 'Total Reviews':
                        case 'Avaliações':
                        case 'Reviews':
                            window.location.href = '/reviews';
                            break;
                        case 'Loja':
                            window.location.href = '/store';
                            break;
                        case 'Recursos':
                            window.location.href = '/resources';
                            break;
                        case 'Criar Empresa':
                            window.location.href = '/companies/create';
                            break;
                        case 'Assinatura':
                            window.location.href = '/subscription';
                            break;
                        case 'Cobrança':
                            window.location.href = '/billing';
                            break;
                        case 'Faturas':
                            window.location.href = '/invoices';
                            break;
                        case 'Suporte':
                            window.location.href = '/support';
                            break;
                        case 'Perfil':
                            window.location.href = '/profile';
                            break;
                        case 'FAQs':
                            window.location.href = '/faqs';
                            break;
                    }
                });
            });
        });
        
    </script>
<<<<<<< HEAD
</body>
</html>
=======
@endsection 
>>>>>>> Perfil-gerenciamento-usuarios
