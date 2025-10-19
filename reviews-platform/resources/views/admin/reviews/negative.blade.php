<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações Negativas - Reviews Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .sidebar-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .alert-card {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border: 2px solid #fecaca;
        }
        
        .urgent-badge {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stars-negative {
            color: #dc2626;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient text-white">
            <div class="p-6">
                <div class="flex items-center mb-8">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-star text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Reviews Platform</h1>
                        <p class="text-blue-100 text-sm">Painel Administrativo</p>
                    </div>
                </div>
                
                <nav class="space-y-2">
                    <a href="/dashboard" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-blue-100 hover:bg-white/20 transition-colors">
                        <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                        Dashboard
                    </a>
                    <a href="/companies" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-blue-100 hover:bg-white/20 transition-colors">
                        <i class="fas fa-building w-5 h-5 mr-3"></i>
                        Empresas
                    </a>
                    <a href="/reviews" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-blue-100 hover:bg-white/20 transition-colors">
                        <i class="fas fa-star w-5 h-5 mr-3"></i>
                        Avaliações
                    </a>
                    <a href="/reviews/negative" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-white bg-white/20">
                        <i class="fas fa-exclamation-triangle w-5 h-5 mr-3"></i>
                        Avaliações Negativas
                    </a>
                    <a href="/reports" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-blue-100 hover:bg-white/20 transition-colors">
                        <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                        Relatórios
                    </a>
                    <a href="/settings" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-blue-100 hover:bg-white/20 transition-colors">
                        <i class="fas fa-cog w-5 h-5 mr-3"></i>
                        Configurações
                    </a>
                </nav>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-red-600">🚨 Avaliações Negativas</h1>
                        <p class="text-gray-600">Avaliações que requerem atenção imediata</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="urgent-badge text-white px-4 py-2 rounded-lg font-bold">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            AÇÃO NECESSÁRIA
                        </div>
                        <button onclick="refreshNegativeReviews()" class="bg-red-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-600 transition-colors">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Atualizar
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Alert Banner -->
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mx-6 mt-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            <strong>Atenção:</strong> Estas avaliações negativas podem impactar a reputação da empresa. 
                            Recomendamos entrar em contato com os clientes o mais rápido possível.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Total Negative Reviews -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total de Negativas</p>
                                <p class="text-2xl font-bold text-red-600" id="totalNegative">0</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Unprocessed Reviews -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-clock text-orange-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Não Processadas</p>
                                <p class="text-2xl font-bold text-orange-600" id="unprocessedNegative">0</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Today's Negatives -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-calendar-day text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Hoje</p>
                                <p class="text-2xl font-bold text-purple-600" id="todayNegative">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Negative Reviews List -->
            <div class="flex-1 overflow-y-auto px-6 pb-6">
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Lista de Avaliações Negativas</h2>
                        <p class="text-gray-600 text-sm">Avaliações que requerem atenção imediata</p>
                    </div>
                    
                    <!-- Loading State -->
                    <div id="loadingState" class="p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                            <i class="fas fa-spinner fa-spin text-red-600 text-2xl"></i>
                        </div>
                        <p class="text-gray-600">Carregando avaliações negativas...</p>
                    </div>
                    
                    <!-- Reviews Container -->
                    <div id="reviewsContainer" class="hidden">
                        <!-- Reviews will be loaded here -->
                    </div>
                    
                    <!-- Empty State -->
                    <div id="emptyState" class="hidden p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Nenhuma avaliação negativa!</h3>
                        <p class="text-gray-600">Parabéns! Todas as avaliações estão positivas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        class NegativeReviewsPanel {
            constructor() {
                this.currentPage = 1;
                this.init();
            }
            
            async init() {
                await this.loadNegativeReviews();
            }
            
            async loadNegativeReviews() {
                try {
                    this.showLoading();
                    
                    const response = await fetch('/api/reviews/negative');
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
                
                if (data.data.length === 0) {
                    emptyState.classList.remove('hidden');
                    container.classList.add('hidden');
                    return;
                }
                
                emptyState.classList.add('hidden');
                container.classList.remove('hidden');
                
                container.innerHTML = data.data.map(review => this.createNegativeReviewCard(review)).join('');
            }
            
            createNegativeReviewCard(review) {
                const today = new Date().toDateString();
                const reviewDate = new Date(review.created_at).toDateString();
                const isToday = today === reviewDate;
                
                return `
                    <div class="p-6 border-b border-gray-200 hover:bg-red-50 transition-colors fade-in">
                        <div class="alert-card rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-red-800">${review.company.name}</h3>
                                        <p class="text-sm text-red-600">
                                            ${isToday ? '🚨 HOJE' : review.created_at}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-red-600">${review.rating}/5</div>
                                    <div class="stars-negative text-lg">
                                        ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center mb-3">
                                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium mr-3">
                                    <i class="fab fa-whatsapp mr-1"></i>
                                    ${review.whatsapp}
                                </div>
                                <button onclick="contactWhatsApp('${review.whatsapp}')" class="bg-green-500 text-white px-3 py-1 rounded-full text-sm hover:bg-green-600 transition-colors">
                                    <i class="fab fa-whatsapp mr-1"></i>
                                    Contatar Agora
                                </button>
                            </div>
                            
                            ${review.comment ? `
                                <div class="bg-white p-3 rounded-lg border border-red-200">
                                    <p class="text-gray-700 italic">"${review.comment}"</p>
                                </div>
                            ` : ''}
                            
                            <div class="flex justify-end space-x-2 mt-4">
                                <button onclick="markAsProcessed(${review.id})" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-check mr-1"></i>
                                    Marcar como Processada
                                </button>
                                <button onclick="sendFollowUp(${review.id})" class="bg-purple-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-purple-600 transition-colors">
                                    <i class="fas fa-envelope mr-1"></i>
                                    Enviar Follow-up
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            updateStats(data) {
                const total = data.total;
                const unprocessed = data.data.filter(r => !r.is_processed).length;
                const today = data.data.filter(r => {
                    const today = new Date().toDateString();
                    const reviewDate = new Date(r.created_at).toDateString();
                    return today === reviewDate;
                }).length;
                
                document.getElementById('totalNegative').textContent = total;
                document.getElementById('unprocessedNegative').textContent = unprocessed;
                document.getElementById('todayNegative').textContent = today;
            }
            
            showLoading() {
                document.getElementById('loadingState').classList.remove('hidden');
                document.getElementById('reviewsContainer').classList.add('hidden');
                document.getElementById('emptyState').classList.add('hidden');
            }
            
            showError(message) {
                document.getElementById('loadingState').classList.add('hidden');
                document.getElementById('reviewsContainer').classList.add('hidden');
                document.getElementById('emptyState').classList.add('hidden');
                
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
        
        // Global functions
        let negativeReviewsPanel;
        
        function refreshNegativeReviews() {
            negativeReviewsPanel.loadNegativeReviews();
        }
        
        function contactWhatsApp(whatsapp) {
            const cleanNumber = whatsapp.replace(/[^0-9]/g, '');
            window.open(`https://wa.me/${cleanNumber}`, '_blank');
        }
        
        function markAsProcessed(reviewId) {
            if (confirm('Tem certeza que deseja marcar esta avaliação como processada?')) {
                // Implementar marcação como processada
                negativeReviewsPanel.showNotification('Avaliação marcada como processada!', 'success');
                negativeReviewsPanel.loadNegativeReviews();
            }
        }
        
        function sendFollowUp(reviewId) {
            // Implementar envio de follow-up
            negativeReviewsPanel.showNotification('Follow-up enviado!', 'success');
        }
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            negativeReviewsPanel = new NegativeReviewsPanel();
        });
    </script>
</body>
</html>
