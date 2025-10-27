@extends('layouts.admin')

@section('title', 'Meu Dashboard')
@section('page-title', 'Meu Dashboard')
@section('page-description', 'Visão geral da sua empresa e avaliações')

@section('content')
<div class="fade-in">
    @if(!$hasCompany)
    <!-- No Company Alert -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6 mb-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-2xl"></i>
            </div>
            <div class="ml-4 flex-1">
                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-300 mb-2">Bem-vindo ao Sistema de Avaliações!</h3>
                <p class="text-blue-800 dark:text-blue-400 mb-4">
                    Você ainda não tem uma empresa cadastrada. Crie sua empresa agora para começar a receber avaliações!
                </p>
                <a href="{{ route('companies.create') }}" class="btn-primary px-6 py-3 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Criar Minha Empresa
                </a>
            </div>
        </div>
    </div>
    @else
    <!-- Company Info Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" 
                         alt="{{ $company->name }}" 
                         class="w-16 h-16 rounded-lg object-cover border-2 border-purple-200">
                @else
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $company->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $company->negative_email }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if($company->status === 'published')
                    <span class="px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-lg font-semibold">
                        <i class="fas fa-check-circle mr-1"></i> Ativa
                    </span>
                @else
                    <span class="px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 rounded-lg font-semibold">
                        <i class="fas fa-clock mr-1"></i> Rascunho
                    </span>
                @endif
                @if($company->status === 'draft')
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn-primary px-4 py-2 rounded-lg text-white inline-flex items-center gap-2">
                        <i class="fas fa-edit"></i>
                        Editar
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 card-hover stagger-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Total de Avaliações</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-gray-100">{{ $stats['total_reviews'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-comment-alt text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 card-hover stagger-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Avaliações Positivas</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $stats['positive_reviews'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-smile text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 card-hover stagger-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Avaliações Negativas</p>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $stats['negative_reviews'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-frown text-red-600 dark:text-red-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 card-hover stagger-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Média de Avaliação</p>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['average_rating'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                    <i class="fas fa-star text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Public Link Card -->
    @if($company->status === 'published')
    <div class="bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900/20 dark:to-blue-900/20 rounded-xl border border-purple-200 dark:border-purple-800 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                    <i class="fas fa-link mr-2"></i>
                    Link Público da Sua Empresa
                </h3>
                <p class="text-gray-700 dark:text-gray-300 mb-3">Compartilhe este link para receber avaliações:</p>
                <div class="flex items-center gap-3">
                    <input type="text" 
                           value="{{ $company->public_url }}" 
                           id="publicUrl"
                           readonly 
                           class="flex-1 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-800 dark:text-gray-200">
                    <button onclick="copyLink()" class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg transition-colors inline-flex items-center gap-2">
                        <i class="fas fa-copy"></i>
                        Copiar
                    </button>
                    <a href="{{ $company->public_url }}" target="_blank" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors inline-flex items-center gap-2">
                        <i class="fas fa-external-link-alt"></i>
                        Visualizar
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Reviews -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                <i class="fas fa-history mr-2"></i>
                Avaliações Recentes
            </h2>
        </div>
        <div class="p-6">
            @if($company->reviews->isEmpty())
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-comment-slash text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Nenhuma avaliação ainda</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Compartilhe o link público para começar a receber avaliações!</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($company->reviews()->latest()->take(5)->get() as $review)
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-{{ $i <= $review->rating ? 'yellow' : 'gray' }}-400"></i>
                                @endfor
                                <span class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $review->rating }}/5</span>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-800 dark:text-gray-200">{{ $review->comment ?? 'Sem comentário' }}</p>
                        @if($review->customer_phone)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                <i class="fas fa-phone mr-1"></i> {{ $review->customer_phone }}
                            </p>
                        @endif
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    function copyLink() {
        const input = document.getElementById('publicUrl');
        input.select();
        document.execCommand('copy');
        showNotification('Link copiado para a área de transferência!', 'success');
    }
</script>
@endsection

