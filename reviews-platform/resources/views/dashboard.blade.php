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
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Submissions Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="far fa-star text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Avaliações</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Visualizar envios de avaliações</p>
                    </div>
                    
                    <!-- Store Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-shopping-cart text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Loja</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Pedir cartões, adesivos e mais para facilitar a coleta de avaliações</p>
                    </div>
                    
                    <!-- Resources Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-file-alt text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Recursos</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Recursos gratuitos para ajudar você a coletar avaliações e prosperar</p>
                    </div>
                    
                    <!-- Create Business Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-th text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Criar Empresa</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Criar uma nova listagem de negócios</p>
                    </div>
                    
                    <!-- Subscription Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-sliders-h text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Assinatura</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Gerenciar seu plano de assinatura</p>
                    </div>
                    
                    <!-- Billing Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="far fa-credit-card text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Cobrança</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Gerenciar cartões salvos</p>
                    </div>
                    
                    <!-- Invoices Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-file-download text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Faturas</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Baixar faturas em PDF</p>
                    </div>
                    
                    <!-- Support Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-life-ring text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Suporte</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Visualizar / criar solicitação de suporte</p>
                    </div>
                    
                    <!-- Profile Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-user text-white text-lg"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Perfil</h3>
                        </div>
                        <p class="text-gray-600 text-sm">Alterar detalhes da conta/login</p>
                    </div>
                </div>
                
                <!-- Additional Cards Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                    <!-- FAQs Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 card-hover cursor-pointer">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 icon-gradient rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-question-circle text-white text-lg"></i>
            </div> 
                            <h3 class="text-lg font-semibold text-gray-800">FAQs</h3>
            </div> 
                        <p class="text-gray-600 text-sm">Perguntas Frequentes</p>
            </div> 
        </div> 
            </main>
        </div> 
    </div> 
    
    <script>
        // Add click handlers for cards
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('click', function() {
                const title = this.querySelector('h3').textContent;
                
                // Simple navigation based on card title
                switch(title) {
                    case 'Avaliações':
                        window.location.href = '/reviews';
                        break;
                    case 'Loja':
                        window.location.href = '/store';
                        break;
                    case 'Recursos':
                        window.location.href = '/resources';
                        break;
                    case 'Criar Empresa':
                        window.location.href = '/companies';
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
        
        // Add hover effects
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    this.style.backgroundColor = 'rgba(139, 92, 246, 0.1)';
                    this.style.color = '#8b5cf6';
                }
            });
            
            item.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.style.backgroundColor = '';
                    this.style.color = '';
                }
            });
        });
        
    </script>
</body>
</html>
