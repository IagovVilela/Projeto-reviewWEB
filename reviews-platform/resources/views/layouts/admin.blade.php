<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Reviews Platform')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Paleta de Cores Unificada */
        :root {
            --primary-gradient: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            --sidebar-gradient: linear-gradient(180deg, #fafafa 0%, #f5f5f5 100%);
            --icon-gradient: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            --primary-color: #8b5cf6;
            --primary-dark: #7c3aed;
            --secondary-color: #ec4899;
            --secondary-dark: #db2777;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            transition: background-color 0.3s ease;
        }
        
        /* Sidebar */
        .sidebar-gradient {
            background: var(--sidebar-gradient);
        }
        
        /* Navigation Items */
        .nav-item {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-item:hover {
            background-color: rgba(139, 92, 246, 0.1);
            color: var(--primary-color);
        }
        
        .nav-item.active {
            background-color: rgba(139, 92, 246, 0.15);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary-gradient);
            border-radius: 0 4px 4px 0;
        }
        
        /* Logo */
        .logo-gradient {
            background: var(--icon-gradient);
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--primary-gradient);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
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
        
        /* Cards */
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* Icon Backgrounds */
        .icon-gradient {
            background: var(--icon-gradient);
        }
        
        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Page Container */
        .page-container {
            min-height: 100vh;
        }
        
        /* Content Area */
        .content-area {
            min-height: calc(100vh - 80px);
        }
        
        @yield('styles')
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen page-container">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient border-r border-gray-200 flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 logo-gradient rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-800">Reviews Platform</h1>
                        <p class="text-xs text-gray-500">Sistema de Avaliações</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    Dashboard
                </a>
                <a href="/companies" class="nav-item {{ request()->is('companies*') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-building w-5 h-5 mr-3"></i>
                    Empresas
                </a>
                <a href="/reviews" class="nav-item {{ request()->is('reviews*') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-star w-5 h-5 mr-3"></i>
                    Avaliações
                </a>
                <a href="/reviews/negative" class="nav-item {{ request()->is('reviews/negative') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-exclamation-triangle w-5 h-5 mr-3"></i>
                    Avaliações Negativas
                </a>
                
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Configurações</p>
                    <a href="/subscription" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-crown w-5 h-5 mr-3"></i>
                        Assinatura
                    </a>
                    <a href="/billing" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-credit-card w-5 h-5 mr-3"></i>
                        Cobrança
                    </a>
                    <a href="/profile" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-user w-5 h-5 mr-3"></i>
                        Perfil
                    </a>
                </div>
                
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Suporte</p>
                    <a href="/support" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-life-ring w-5 h-5 mr-3"></i>
                        Central de Ajuda
                    </a>
                    <a href="/faqs" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-question-circle w-5 h-5 mr-3"></i>
                        FAQs
                    </a>
                </div>
            </nav>
            
            <!-- User Section -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? 'Usuário' }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                    </div>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        Sair
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-gray-600 text-sm">@yield('page-description', 'Bem-vindo ao sistema')</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        @yield('header-actions')
                    </div>
                </div>
            </header>
            
            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6 content-area">
                <!-- Notifications -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 fade-in">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 fade-in">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 fade-in">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle mr-2 mt-1"></i>
                            <div class="flex-1">
                                <p class="font-medium mb-1">Por favor, corrija os seguintes erros:</p>
                                <ul class="list-disc list-inside text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Page Content -->
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        // Notification System
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg fade-in ${
                type === 'success' ? 'bg-green-500' :
                type === 'error' ? 'bg-red-500' :
                type === 'warning' ? 'bg-yellow-500' :
                'bg-blue-500'
            } text-white`;
            
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${
                        type === 'success' ? 'check-circle' :
                        type === 'error' ? 'exclamation-circle' :
                        type === 'warning' ? 'exclamation-triangle' :
                        'info-circle'
                    } mr-3"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
        
        // Auto-hide success/error messages
        setTimeout(() => {
            document.querySelectorAll('.bg-green-50, .bg-red-50').forEach(el => {
                if (el.textContent.includes('{{ session('success') }}') || el.textContent.includes('{{ session('error') }}')) {
                    el.style.transition = 'opacity 0.3s';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 300);
                }
            });
        }, 5000);
    </script>
    
    @yield('scripts')
</body>
</html>

