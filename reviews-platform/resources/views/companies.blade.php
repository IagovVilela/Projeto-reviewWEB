<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas - Reviews Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .sidebar-gradient { background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%); }
        .nav-item { transition: all 0.3s ease; }
        .nav-item:hover { background-color: rgba(139, 92, 246, 0.1); color: #8b5cf6; }
        .nav-item.active { background-color: rgba(139, 92, 246, 0.15); color: #8b5cf6; font-weight: 600; }
        .logo-gradient { background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%); }
        .btn-primary { background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%); transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient shadow-lg">
            <div class="p-6">
                <div class="logo-gradient text-white p-3 rounded-xl mb-8">
                    <h1 class="text-lg font-bold">Reviews Platform</h1>
                </div>
                
                <nav class="space-y-2">
                    <a href="/dashboard" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="/companies" class="nav-item active flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700">
                        <i class="fas fa-building"></i>
                        <span>Empresas</span>
                    </a>
                    <a href="/companies/create" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700">
                        <i class="fas fa-plus"></i>
                        <span>Criar Empresa</span>
                    </a>
                    <a href="/reviews" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700">
                        <i class="fas fa-star"></i>
                        <span>Avaliações</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Empresas Cadastradas</h1>
                        <p class="text-gray-600 mt-1">Gerencie todas as suas empresas</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="/companies/create" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
                            <i class="fas fa-plus mr-2"></i>
                            NOVA EMPRESA
                        </a>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                        @if(session('company_url'))
                            <div class="mt-2">
                                <a href="{{ session('company_url') }}" target="_blank" class="text-green-600 hover:underline">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    Ver página pública
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                @if($companies->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($companies as $company)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        @if($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="w-12 h-12 rounded-lg object-cover">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-building text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-semibold text-gray-800">{{ $company->name }}</h3>
                                            <p class="text-sm text-gray-500">{{ $company->created_at->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $company->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $company->is_active ? 'Ativo' : 'Inativo' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-envelope w-4 mr-2"></i>
                                        <span>{{ $company->negative_email }}</span>
                                    </div>
                                    @if($company->contact_number)
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-phone w-4 mr-2"></i>
                                            <span>{{ $company->contact_number }}</span>
                                        </div>
                                    @endif
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class="fas fa-star w-4 mr-2"></i>
                                        <span>Limite: {{ $company->positive_score }} estrelas</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center space-x-4">
                                        <span><i class="fas fa-eye mr-1"></i> {{ $company->review_pages_count }} páginas</span>
                                        <span><i class="fas fa-comment mr-1"></i> {{ $company->reviews_count }} avaliações</span>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <a href="{{ $company->public_url }}" target="_blank" class="flex-1 bg-blue-50 text-blue-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors text-center">
                                        <i class="fas fa-external-link-alt mr-1"></i>
                                        Ver Página
                                    </a>
                                    <form method="POST" action="{{ route('companies.destroy', $company->id) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir esta empresa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-50 text-red-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-100 transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-building text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Nenhuma empresa cadastrada</h3>
                        <p class="text-gray-600 mb-6">Comece criando sua primeira empresa para coletar avaliações</p>
                        <a href="/companies/create" class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                            <i class="fas fa-plus mr-2"></i>
                            Criar Primeira Empresa
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>
</body>
</html>