@extends('layouts.admin')

@section('title', 'Avaliações Negativas - Reviews Platform')

@section('page-title', '🚨 Avaliações Negativas')
@section('page-description', 'Avaliações que requerem atenção imediata')

@section('header-actions')
    <div class="urgent-badge text-white px-4 py-2 rounded-lg font-bold pulse-soft">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        AÇÃO NECESSÁRIA
    </div>
    <button onclick="refreshNegativeReviews()" class="bg-red-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-600 transition-colors">
        <i class="fas fa-sync-alt mr-2"></i>
        Atualizar
    </button>
@endsection

@section('styles')
    <style>
        .alert-card {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 2px solid #fecaca;
            transition: var(--transition-smooth);
        }
        
        .dark .alert-card {
            background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%);
            border: 2px solid #b91c1c;
        }
        
        .alert-card:hover {
            border-color: #fca5a5;
            box-shadow: 0 8px 16px rgba(239, 68, 68, 0.15);
        }
        
        .dark .alert-card:hover {
            border-color: #dc2626;
            box-shadow: 0 8px 16px rgba(239, 68, 68, 0.25);
        }
        
        .urgent-badge {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            position: relative;
            overflow: hidden;
        }
        
        .urgent-badge::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .urgent-badge:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .stars-negative {
            color: #dc2626;
        }
        
        .priority-high {
            animation: pulseRed 2s infinite;
        }
        
        @keyframes pulseRed {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.4);
            }
            50% {
                box-shadow: 0 0 0 10px rgba(220, 38, 38, 0);
            }
        }
        
        .review-action-btn {
            transition: var(--transition-smooth);
        }
        
        .review-action-btn:hover {
            transform: translateY(-2px);
        }
    </style>
@endsection

@section('content')
    <!-- Alert Banner -->
    <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-400 dark:border-red-600 p-4 rounded-lg mb-6 fade-in">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-400 dark:text-red-500 text-xl"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700 dark:text-red-300">
                    <strong>Atenção:</strong> Estas avaliações negativas podem impactar a reputação da empresa. 
                    Recomendamos entrar em contato com os clientes o mais rápido possível.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Negative Reviews -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 card-hover stagger-item border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total de Negativas</p>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400" id="totalNegative">0</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-arrow-down trend-down"></i> Últimas 24h
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Unprocessed Reviews -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 card-hover stagger-item priority-high border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-4 pulse-soft">
                    <i class="fas fa-clock text-orange-600 dark:text-orange-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Não Processadas</p>
                    <p class="text-2xl font-bold text-orange-600 dark:text-orange-400" id="unprocessedNegative">0</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-exclamation-circle"></i> Requer ação
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Today's Negatives -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 card-hover stagger-item border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-4 shimmer">
                    <i class="fas fa-calendar-day text-purple-600 dark:text-purple-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Hoje</p>
                    <p class="text-2xl font-bold text-purple-600 dark:text-purple-400" id="todayNegative">0</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-clock"></i> Últimas 24h
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Negative Reviews List -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Lista de Avaliações Negativas</h2>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Avaliações que requerem atenção imediata</p>
                </div>
                <div class="flex items-center space-x-3">
                    <select id="sortFilter" class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 rounded-lg text-sm focus:ring-2 focus:ring-red-500">
                        <option value="recent">Mais recentes</option>
                        <option value="oldest">Mais antigas</option>
                        <option value="lowest">Menor nota</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Loading State -->
        <div id="loadingState" class="p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full mb-4">
                <i class="fas fa-spinner fa-spin text-red-600 dark:text-red-400 text-2xl"></i>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Carregando avaliações negativas...</p>
        </div>
        
        <!-- Reviews Container -->
        <div id="reviewsContainer" class="hidden">
            <!-- Reviews will be loaded here -->
        </div>
        
        <!-- Empty State -->
        <div id="emptyState" class="hidden p-12 text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full mb-6 scale-in">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Nenhuma avaliação negativa!</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">Parabéns! Todas as avaliações estão positivas.</p>
            <div class="inline-flex items-center text-green-600 dark:text-green-400 text-sm font-medium">
                <i class="fas fa-trophy mr-2"></i>
                Excelente trabalho mantendo alta qualidade!
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        class NegativeReviewsPanel {
            constructor() {
                this.currentPage = 1;
                this.sortBy = 'recent';
                this.init();
            }
            
            async init() {
                await this.loadNegativeReviews();
                this.bindEvents();
            }
            
            bindEvents() {
                document.getElementById('sortFilter').addEventListener('change', (e) => {
                    this.sortBy = e.target.value;
                    this.loadNegativeReviews();
                });
            }
            
            async loadNegativeReviews() {
                try {
                    this.showLoading();
                    
                    const params = new URLSearchParams({
                        sort: this.sortBy,
                        page: this.currentPage
                    });
                    
                    const response = await fetch(`/api/reviews/negative?${params}`);
                    const result = await response.json();
                    
                    if (result.success) {
                        this.displayNegativeReviews(result.data);
                        this.updateStats(result.data);
                    } else {
                        this.showError('Erro ao carregar avaliações negativas');
                    }
                } catch (error) {
                    console.error('Erro ao carregar avaliações negativas:', error);
                    this.showError('Erro ao carregar avaliações negativas');
                }
            }
            
            displayNegativeReviews(data) {
                const container = document.getElementById('reviewsContainer');
                const loadingState = document.getElementById('loadingState');
                const emptyState = document.getElementById('emptyState');
                
                loadingState.classList.add('hidden');
                
                const reviews = data.data || data;
                
                if (reviews.length === 0) {
                    emptyState.classList.remove('hidden');
                    container.classList.add('hidden');
                    return;
                }
                
                emptyState.classList.add('hidden');
                container.classList.remove('hidden');
                
                container.innerHTML = reviews.map((review, index) => 
                    this.createNegativeReviewCard(review, index)
                ).join('');
            }
            
            createNegativeReviewCard(review, index) {
                const today = new Date().toDateString();
                const reviewDate = new Date(review.created_at).toDateString();
                const isToday = today === reviewDate;
                
                return `
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 hover:bg-red-50 dark:hover:bg-gray-700/50 transition-all stagger-item" style="animation-delay: ${index * 0.05}s">
                        <div class="alert-card rounded-xl p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center flex-1">
                                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-4 shadow-lg shimmer">
                                        <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-bold text-red-800 dark:text-red-300 text-lg">${review.company.name}</h3>
                                        <div class="flex items-center mt-1 space-x-2">
                                            <span class="text-sm text-red-600 dark:text-red-400">
                                                ${isToday ? '<span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold animate-pulse">🚨 HOJE</span>' : `<i class="far fa-clock mr-1"></i>${review.created_at}`}
                                            </span>
                                            ${!review.is_processed ? '<span class="bg-orange-100 dark:bg-orange-900/40 text-orange-800 dark:text-orange-300 px-2 py-1 rounded-full text-xs font-medium">Não Processada</span>' : ''}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold text-red-600 dark:text-red-400">${review.rating}/5</div>
                                    <div class="stars-negative text-xl mt-1">
                                        ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center mb-4 space-x-3">
                                <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-300 px-4 py-2 rounded-lg text-sm font-medium">
                                    <i class="fab fa-whatsapp mr-2"></i>
                                    ${review.whatsapp}
                                </div>
                                <button onclick="contactWhatsApp('${review.whatsapp}')" class="btn-primary text-white px-4 py-2 rounded-lg text-sm font-medium review-action-btn">
                                    <i class="fab fa-whatsapp mr-2"></i>
                                    Contatar Agora
                                </button>
                            </div>
                            
                            ${review.comment ? `
                                <div class="bg-white dark:bg-gray-900/50 p-4 rounded-lg border-2 border-red-200 dark:border-red-800 mb-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Comentário do cliente:</p>
                                    <p class="text-gray-800 dark:text-gray-200 italic">"${review.comment}"</p>
                                </div>
                            ` : ''}
                            
                            ${review.private_feedback ? `
                                <div class="bg-orange-50 dark:bg-orange-900/30 p-4 rounded-lg border-2 border-orange-200 dark:border-orange-700 mb-4">
                                    <p class="text-sm text-orange-700 dark:text-orange-400 font-medium mb-1">
                                        <i class="fas fa-lock mr-1"></i> Feedback Privado:
                                    </p>
                                    <p class="text-gray-700 dark:text-gray-300">${review.private_feedback}</p>
                                </div>
                            ` : ''}
                            
                            <div class="flex flex-wrap gap-2">
                                <button onclick="markAsProcessed(${review.id})" class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all review-action-btn">
                                    <i class="fas fa-check mr-2"></i>
                                    Marcar como Processada
                                </button>
                                <button onclick="sendFollowUp(${review.id})" class="bg-purple-500 hover:bg-purple-600 dark:bg-purple-600 dark:hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all review-action-btn">
                                    <i class="fas fa-envelope mr-2"></i>
                                    Enviar Follow-up
                                </button>
                                <button onclick="addNote(${review.id})" class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all review-action-btn">
                                    <i class="fas fa-sticky-note mr-2"></i>
                                    Adicionar Nota
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            updateStats(data) {
                const reviews = data.data || data;
                const total = data.total || reviews.length;
                const unprocessed = reviews.filter(r => !r.is_processed).length;
                const today = reviews.filter(r => {
                    const today = new Date().toDateString();
                    const reviewDate = new Date(r.created_at).toDateString();
                    return today === reviewDate;
                }).length;
                
                document.getElementById('totalNegative').textContent = total;
                document.getElementById('unprocessedNegative').textContent = unprocessed;
                document.getElementById('todayNegative').textContent = today;
                
                // Update page title with count
                if (unprocessed > 0) {
                    document.title = `(${unprocessed}) Avaliações Negativas - Reviews Platform`;
                }
            }
            
            showLoading() {
                document.getElementById('loadingState').classList.remove('hidden');
                document.getElementById('reviewsContainer').classList.add('hidden');
                document.getElementById('emptyState').classList.add('hidden');
            }
            
            showError(message) {
                document.getElementById('loadingState').classList.add('hidden');
                showNotification(message, 'error');
            }
        }
        
        // Global functions
        let negativeReviewsPanel;
        
        function refreshNegativeReviews() {
            negativeReviewsPanel.loadNegativeReviews();
            showNotification('Atualizando avaliações...', 'info');
        }
        
        function contactWhatsApp(whatsapp) {
            const cleanNumber = whatsapp.replace(/[^0-9]/g, '');
            window.open(`https://wa.me/${cleanNumber}`, '_blank');
            showNotification('Abrindo WhatsApp...', 'success');
        }
        
        async function markAsProcessed(reviewId) {
            if (confirm('Tem certeza que deseja marcar esta avaliação como processada?')) {
                try {
                    const loader = showLoading('Processando...');
                    
                    // Simular API call
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    
                    hideLoading();
                    showNotification('Avaliação marcada como processada!', 'success');
                    negativeReviewsPanel.loadNegativeReviews();
                } catch (error) {
                    hideLoading();
                    showNotification('Erro ao processar avaliação', 'error');
                }
            }
        }
        
        async function sendFollowUp(reviewId) {
            const message = prompt('Digite a mensagem de follow-up (opcional):');
            
            if (message !== null) {
                try {
                    const loader = showLoading('Enviando follow-up...');
                    
                    // Simular API call
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    
                    hideLoading();
                    showNotification('Follow-up enviado com sucesso!', 'success');
                } catch (error) {
                    hideLoading();
                    showNotification('Erro ao enviar follow-up', 'error');
                }
            }
        }
        
        async function addNote(reviewId) {
            const note = prompt('Adicionar nota interna:');
            
            if (note && note.trim()) {
                try {
                    const loader = showLoading('Salvando nota...');
                    
                    // Simular API call
                    await new Promise(resolve => setTimeout(resolve, 500));
                    
                    hideLoading();
                    showNotification('Nota adicionada com sucesso!', 'success');
                } catch (error) {
                    hideLoading();
                    showNotification('Erro ao salvar nota', 'error');
                }
            }
        }
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            negativeReviewsPanel = new NegativeReviewsPanel();
        });
    </script>
@endsection
