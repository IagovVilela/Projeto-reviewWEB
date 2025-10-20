<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Avaliações - Reviews Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        
        .rating-positive {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .rating-negative {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .filter-active {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .pulse-alert {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }
        
        /* Garantir que a página tenha scroll */
        body {
            overflow-y: auto !important;
        }
        
        .main-container {
            min-height: 100vh;
            overflow-y: auto;
        }
        
        .metric-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 1px solid #e2e8f0;
        }
        
        .trend-up {
            color: #10b981;
        }
        
        .trend-down {
            color: #ef4444;
        }
        
        .trend-neutral {
            color: #6b7280;
        }
        
        .chart-period-btn.active {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen main-container">
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
                    <a href="/reviews" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-white bg-white/20">
                        <i class="fas fa-star w-5 h-5 mr-3"></i>
                        Avaliações
                    </a>
                    <a href="/reviews/negative" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-blue-100 hover:bg-white/20 transition-colors">
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
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Painel de Avaliações</h1>
                        <p class="text-gray-600">Gerencie todas as avaliações recebidas</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button onclick="exportContacts(this)" class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-600 transition-colors">
                            <i class="fas fa-download mr-2"></i>
                            Exportar Contatos
                        </button>
                        <button onclick="refreshReviews()" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-600 transition-colors">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Atualizar
                        </button>
                    </div>
                </div>
            </header>
            
            <!-- Filters -->
            <div class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Company Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
                        <select id="companyFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Todas as empresas</option>
                        </select>
                    </div>
                    
                    <!-- Type Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                        <select id="typeFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Todas</option>
                            <option value="positive">Positivas (4-5★)</option>
                            <option value="negative">Negativas (1-3★)</option>
                        </select>
                    </div>
                    
                    <!-- Rating Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nota</label>
                        <select id="ratingFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Todas as notas</option>
                            <option value="5">5 estrelas</option>
                            <option value="4">4 estrelas</option>
                            <option value="3">3 estrelas</option>
                            <option value="2">2 estrelas</option>
                            <option value="1">1 estrela</option>
                        </select>
                    </div>
                    
                    <!-- Date Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Período</label>
                        <select id="dateFilter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Todos os períodos</option>
                            <option value="today">Hoje</option>
                            <option value="week">Esta semana</option>
                            <option value="month">Este mês</option>
                        </select>
                    </div>
                    
                    <button onclick="applyFilters()" class="bg-purple-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-purple-600 transition-colors">
                        <i class="fas fa-filter mr-2"></i>
                        Aplicar Filtros
                    </button>
                    
                    <button onclick="clearFilters()" class="bg-gray-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-600 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        Limpar
                    </button>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <!-- Total Reviews -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-star text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total de Avaliações</p>
                                <p class="text-2xl font-bold text-gray-800" id="totalReviews">0</p>
                                <p class="text-xs text-gray-500" id="totalReviewsTrend">
                                    <i class="fas fa-arrow-up trend-up"></i> +12% vs mês anterior
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Positive Reviews -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-thumbs-up text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Avaliações Positivas</p>
                                <p class="text-2xl font-bold text-green-600" id="positiveReviews">0</p>
                                <p class="text-xs text-gray-500" id="positiveReviewsTrend">
                                    <i class="fas fa-arrow-up trend-up"></i> +8% vs mês anterior
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Negative Reviews -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4 pulse-alert">
                                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Avaliações Negativas</p>
                                <p class="text-2xl font-bold text-red-600" id="negativeReviews">0</p>
                                <p class="text-xs text-gray-500" id="negativeReviewsTrend">
                                    <i class="fas fa-arrow-down trend-down"></i> -5% vs mês anterior
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Average Rating -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600">Média Geral</p>
                                <p class="text-2xl font-bold text-yellow-600" id="averageRating">0.0</p>
                                <p class="text-xs text-gray-500" id="averageRatingTrend">
                                    <i class="fas fa-arrow-up trend-up"></i> +0.3 vs mês anterior
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Reviews Over Time Chart -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Avaliações ao Longo do Tempo</h3>
                                <p class="text-sm text-gray-500" id="chartPeriodInfo">Visualização por dias</p>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="updateChartPeriod('7d')" class="chart-period-btn period-tab active px-3 py-1 text-xs rounded-full bg-purple-500 text-white">7 dias</button>
                                <button onclick="updateChartPeriod('30d')" class="chart-period-btn period-tab px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-600">30 dias</button>
                                <button onclick="updateChartPeriod('90d')" class="chart-period-btn period-tab px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-600">90 dias</button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="reviewsOverTimeChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Rating Distribution Chart -->
                    <div class="bg-white rounded-xl p-6 card-hover">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Distribuição de Notas</h3>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Positivas</span>
                                <div class="w-3 h-3 bg-red-500 rounded-full ml-4"></div>
                                <span class="text-sm text-gray-600">Negativas</span>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="ratingDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Company Performance Table -->
                <div class="bg-white rounded-xl p-6 card-hover mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Performance por Empresa</h3>
                        <button onclick="exportCompanyData()" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600 transition-colors">
                            <i class="fas fa-download mr-2"></i>
                            Exportar Dados
                        </button>
                    </div>
                    <div class="table-container">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Empresa</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Total</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Positivas</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Negativas</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Média</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Última Avaliação</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="companyPerformanceTable">
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Reviews List -->
            <div class="flex-1 px-6 pb-6">
                <div class="bg-white rounded-xl shadow-sm">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Lista de Avaliações</h2>
                        <p class="text-gray-600 text-sm">Últimas avaliações recebidas</p>
                    </div>
                    
                    <!-- Loading State -->
                    <div id="loadingState" class="p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                            <i class="fas fa-spinner fa-spin text-blue-600 text-2xl"></i>
                        </div>
                        <p class="text-gray-600">Carregando avaliações...</p>
                    </div>
                    
                    <!-- Reviews Container -->
                    <div id="reviewsContainer" class="hidden">
                        <!-- Reviews will be loaded here -->
                    </div>
                    
                    <!-- Empty State -->
                    <div id="emptyState" class="hidden p-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <i class="fas fa-star text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Nenhuma avaliação encontrada</h3>
                        <p class="text-gray-600">Tente ajustar os filtros ou aguarde novas avaliações.</p>
                    </div>
                    
                    <!-- Pagination -->
                    <div id="paginationContainer" class="hidden p-6 border-t border-gray-200">
                        <!-- Pagination will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        class ReviewsPanel {
            constructor() {
                this.currentPage = 1;
                this.filters = {
                    company_id: '',
                    type: '',
                    rating: '',
                    date: ''
                };
                this.companies = [];
                this.charts = {};
                this.init();
            }
            
            async init() {
                await this.loadCompanies();
                await this.loadReviews();
                this.initializeCharts();
                this.bindEvents();
            }
            
            async loadCompanies() {
                try {
                    const response = await fetch('/api/companies');
                    const result = await response.json();
                    
                    if (result.success) {
                        this.companies = result.data;
                        this.populateCompanyFilter();
                    }
                } catch (error) {
                    console.error('Erro ao carregar empresas:', error);
                }
            }
            
            populateCompanyFilter() {
                const select = document.getElementById('companyFilter');
                select.innerHTML = '<option value="">Todas as empresas</option>';
                
                this.companies.forEach(company => {
                    const option = document.createElement('option');
                    option.value = company.id;
                    option.textContent = company.name;
                    select.appendChild(option);
                });
            }
            
            async loadReviews() {
                try {
                    this.showLoading();
                    
                    const params = new URLSearchParams({
                        page: this.currentPage,
                        ...this.filters
                    });
                    
                    const response = await fetch(`/api/reviews?${params}`);
                    const result = await response.json();
                    
                    if (result.success) {
                        this.displayReviews(result.data);
                        this.updateStats(result.data);
                        this.updateCompanyPerformanceTable(result.data);
                        this.updateChartsWithRealData(result.data.data || result.data);
                    } else {
                        this.showError('Erro ao carregar avaliações');
                    }
                } catch (error) {
                    console.error('Erro ao carregar avaliações:', error);
                    this.showError('Erro ao carregar avaliações');
                }
            }
            
            updateChartsWithRealData(reviews) {
                if (!reviews || reviews.length === 0) {
                    // Se não há avaliações, manter gráficos zerados
                    this.updateChartsWithEmptyData();
                    return;
                }
                
                // Atualizar gráfico de distribuição de notas
                const ratingCounts = [0, 0, 0, 0, 0]; // [5★, 4★, 3★, 2★, 1★]
                
                reviews.forEach(review => {
                    const rating = review.rating;
                    if (rating >= 1 && rating <= 5) {
                        ratingCounts[5 - rating]++; // 5★ = index 0, 4★ = index 1, etc.
                    }
                });
                
                if (this.charts.ratingDistribution) {
                    this.charts.ratingDistribution.data.datasets[0].data = ratingCounts;
                    this.charts.ratingDistribution.update();
                }
                
                // Atualizar gráfico de avaliações ao longo do tempo baseado no período selecionado
                this.updateTimeChartWithRealData(reviews);
            }
            
            updateChartsWithEmptyData() {
                // Zerar gráfico de distribuição de notas
                if (this.charts.ratingDistribution) {
                    this.charts.ratingDistribution.data.datasets[0].data = [0, 0, 0, 0, 0];
                    this.charts.ratingDistribution.update();
                }
                
                // Zerar gráfico de avaliações ao longo do tempo
                this.updateTimeChartWithEmptyData();
            }
            
            updateTimeChartWithRealData(reviews) {
                const selectedPeriod = this.getSelectedPeriod();
                let timeData, labels;
                
                if (selectedPeriod === '7') {
                    // Para 7 dias: mostrar cada dia individualmente
                    const last7Days = this.getLast7Days();
                    timeData = {
                        positive: new Array(7).fill(0),
                        negative: new Array(7).fill(0)
                    };
                    labels = last7Days.map(day => {
                        const date = new Date(day);
                        return date.toLocaleDateString('pt-BR', { weekday: 'short' });
                    });
                    
                    reviews.forEach(review => {
                        const reviewDate = new Date(review.created_at);
                        const dayIndex = this.getDayIndex(reviewDate, last7Days);
                        
                        if (dayIndex >= 0 && dayIndex < 7) {
                            if (review.is_positive) {
                                timeData.positive[dayIndex]++;
                            } else {
                                timeData.negative[dayIndex]++;
                            }
                        }
                    });
                } else if (selectedPeriod === '30') {
                    // Para 30 dias: agrupar por semanas (4 semanas)
                    const weeklyData = this.groupReviewsByWeeks(reviews, 30);
                    timeData = {
                        positive: weeklyData.positive,
                        negative: weeklyData.negative
                    };
                    labels = weeklyData.labels;
                } else if (selectedPeriod === '90') {
                    // Para 90 dias: agrupar por semanas (12 semanas)
                    const weeklyData = this.groupReviewsByWeeks(reviews, 90);
                    timeData = {
                        positive: weeklyData.positive,
                        negative: weeklyData.negative
                    };
                    labels = weeklyData.labels;
                }
                
                if (this.charts.reviewsOverTime && timeData && labels) {
                    this.charts.reviewsOverTime.data.labels = labels;
                    this.charts.reviewsOverTime.data.datasets[0].data = timeData.positive;
                    this.charts.reviewsOverTime.data.datasets[1].data = timeData.negative;
                    this.charts.reviewsOverTime.update();
                }
            }
            
            updateTimeChartWithEmptyData() {
                const selectedPeriod = this.getSelectedPeriod();
                let labels;
                
                if (selectedPeriod === '7') {
                    const last7Days = this.getLast7Days();
                    labels = last7Days.map(day => {
                        const date = new Date(day);
                        return date.toLocaleDateString('pt-BR', { weekday: 'short' });
                    });
                } else if (selectedPeriod === '30') {
                    // Para 30 dias: 4 semanas
                    labels = this.generateWeekLabels(4);
                } else if (selectedPeriod === '90') {
                    // Para 90 dias: 12 semanas
                    labels = this.generateWeekLabels(12);
                }
                
                if (this.charts.reviewsOverTime && labels) {
                    this.charts.reviewsOverTime.data.labels = labels;
                    this.charts.reviewsOverTime.data.datasets[0].data = new Array(labels.length).fill(0);
                    this.charts.reviewsOverTime.data.datasets[1].data = new Array(labels.length).fill(0);
                    this.charts.reviewsOverTime.update();
                }
            }
            
            generateWeekLabels(weeksCount) {
                const labels = [];
                for (let i = weeksCount - 1; i >= 0; i--) {
                    const startDate = new Date();
                    startDate.setDate(startDate.getDate() - (i * 7 + 6));
                    const endDate = new Date();
                    endDate.setDate(endDate.getDate() - (i * 7));
                    
                    const startStr = startDate.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
                    const endStr = endDate.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
                    labels.push(`${startStr} - ${endStr}`);
                }
                return labels.reverse(); // Mais recente primeiro
            }
            
            getSelectedPeriod() {
                // Verificar qual aba está ativa
                const activeTab = document.querySelector('.period-tab.active');
                if (activeTab) {
                    const text = activeTab.textContent.trim();
                    if (text.includes('7')) return '7';
                    if (text.includes('30')) return '30';
                    if (text.includes('90')) return '90';
                }
                return '7'; // Default
            }
            
            getLast30Days() {
                const days = [];
                for (let i = 29; i >= 0; i--) {
                    const date = new Date();
                    date.setDate(date.getDate() - i);
                    days.push(date.toISOString().split('T')[0]); // Formato YYYY-MM-DD
                }
                return days;
            }
            
            getLast90Days() {
                const days = [];
                for (let i = 89; i >= 0; i--) {
                    const date = new Date();
                    date.setDate(date.getDate() - i);
                    days.push(date.toISOString().split('T')[0]); // Formato YYYY-MM-DD
                }
                return days;
            }
            
            getLast7Days() {
                const days = [];
                for (let i = 6; i >= 0; i--) {
                    const date = new Date();
                    date.setDate(date.getDate() - i);
                    days.push(date.toISOString().split('T')[0]);
                }
                return days;
            }
            
            getDayIndex(reviewDate, last7Days) {
                const reviewDateStr = reviewDate.toISOString().split('T')[0];
                return last7Days.indexOf(reviewDateStr);
            }
            
            groupReviewsByWeeks(reviews, days) {
                const weeksCount = Math.ceil(days / 7);
                const positive = new Array(weeksCount).fill(0);
                const negative = new Array(weeksCount).fill(0);
                const labels = [];
                
                // Gerar labels das semanas
                for (let i = weeksCount - 1; i >= 0; i--) {
                    const startDate = new Date();
                    startDate.setDate(startDate.getDate() - (i * 7 + 6));
                    const endDate = new Date();
                    endDate.setDate(endDate.getDate() - (i * 7));
                    
                    const startStr = startDate.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
                    const endStr = endDate.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
                    labels.push(`${startStr} - ${endStr}`);
                }
                
                // Agrupar avaliações por semana
                reviews.forEach(review => {
                    const reviewDate = new Date(review.created_at);
                    const daysAgo = Math.floor((new Date() - reviewDate) / (1000 * 60 * 60 * 24));
                    const weekIndex = Math.floor(daysAgo / 7);
                    
                    if (weekIndex >= 0 && weekIndex < weeksCount) {
                        if (review.is_positive) {
                            positive[weekIndex]++;
                        } else {
                            negative[weekIndex]++;
                        }
                    }
                });
                
                return {
                    positive: positive.reverse(), // Mais recente primeiro
                    negative: negative.reverse(),
                    labels: labels.reverse()
                };
            }
            
            initializeCharts() {
                // Reviews Over Time Chart
                const reviewsOverTimeCtx = document.getElementById('reviewsOverTimeChart').getContext('2d');
                this.charts.reviewsOverTime = new Chart(reviewsOverTimeCtx, {
                    type: 'line',
                    data: {
                        labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                        datasets: [{
                            label: 'Positivas',
                            data: [0, 0, 0, 0, 0, 0, 0], // Será atualizado com dados reais
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4
                        }, {
                            label: 'Negativas',
                            data: [0, 0, 0, 0, 0, 0, 0], // Será atualizado com dados reais
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                callbacks: {
                                    title: function(tooltipItems) {
                                        const period = document.querySelector('.period-tab.active').textContent.trim();
                                        if (period.includes('7')) {
                                            return tooltipItems[0].label;
                                        } else {
                                            return `Semana: ${tooltipItems[0].label}`;
                                        }
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                ticks: {
                                    maxRotation: 45,
                                    minRotation: 0,
                                    maxTicksLimit: 12
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        interaction: {
                            mode: 'index',
                            intersect: false,
                        }
                    }
                });
                
                // Rating Distribution Chart
                const ratingDistributionCtx = document.getElementById('ratingDistributionChart').getContext('2d');
                this.charts.ratingDistribution = new Chart(ratingDistributionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['5★', '4★', '3★', '2★', '1★'],
                        datasets: [{
                            data: [0, 0, 0, 0, 0], // Será atualizado com dados reais
                            backgroundColor: [
                                '#10b981',
                                '#34d399',
                                '#fbbf24',
                                '#f59e0b',
                                '#ef4444'
                            ],
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            }
                        }
                    }
                });
            }
            
            updateChartPeriod(period) {
                // Update chart period buttons
                document.querySelectorAll('.chart-period-btn').forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.add('bg-gray-200', 'text-gray-600');
                    btn.classList.remove('bg-purple-500', 'text-white');
                });
                
                event.target.classList.add('active');
                event.target.classList.remove('bg-gray-200', 'text-gray-600');
                event.target.classList.add('bg-purple-500', 'text-white');
                
                // Update period info text
                const periodInfo = document.getElementById('chartPeriodInfo');
                if (periodInfo) {
                    if (period === '7d') {
                        periodInfo.textContent = 'Visualização por dias';
                    } else if (period === '30d') {
                        periodInfo.textContent = 'Visualização por semanas (4 semanas)';
                    } else if (period === '90d') {
                        periodInfo.textContent = 'Visualização por semanas (12 semanas)';
                    }
                }
                
                // Update chart data based on period
                this.loadChartData(period);
            }
            
            async loadChartData(period) {
                // Usar dados reais em vez de dados fictícios
                // Recarregar avaliações para atualizar os gráficos com dados reais
                try {
                    await this.loadReviews();
                    console.log(`Gráficos atualizados com dados reais para período: ${period}`);
                } catch (error) {
                    console.error('Erro ao carregar dados reais:', error);
                }
            }
            
            updateCompanyPerformanceTable(data) {
                const tbody = document.getElementById('companyPerformanceTable');
                
                // Verificar se data tem estrutura de paginação ou é array direto
                const reviews = data.data || data;
                
                // Group reviews by company
                const companyStats = {};
                reviews.forEach(review => {
                    if (!companyStats[review.company.id]) {
                        companyStats[review.company.id] = {
                            name: review.company.name,
                            total: 0,
                            positive: 0,
                            negative: 0,
                            ratings: [],
                            lastReview: null
                        };
                    }
                    
                    companyStats[review.company.id].total++;
                    if (review.is_positive) {
                        companyStats[review.company.id].positive++;
                    } else {
                        companyStats[review.company.id].negative++;
                    }
                    companyStats[review.company.id].ratings.push(review.rating);
                    
                    if (!companyStats[review.company.id].lastReview || 
                        new Date(review.created_at) > new Date(companyStats[review.company.id].lastReview)) {
                        companyStats[review.company.id].lastReview = review.created_at;
                    }
                });
                
                // Generate table rows
                tbody.innerHTML = Object.entries(companyStats).map(([companyId, company]) => {
                    const average = company.ratings.length > 0 ? 
                        (company.ratings.reduce((sum, rating) => sum + rating, 0) / company.ratings.length).toFixed(1) : '0.0';
                    
                    return `
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">${company.name}</td>
                            <td class="px-4 py-3 text-gray-600">${company.total}</td>
                            <td class="px-4 py-3 text-green-600 font-medium">${company.positive}</td>
                            <td class="px-4 py-3 text-red-600 font-medium">${company.negative}</td>
                            <td class="px-4 py-3 text-gray-600">${average}</td>
                            <td class="px-4 py-3 text-gray-500 text-sm">${company.lastReview ? new Date(company.lastReview).toLocaleDateString('pt-BR') : 'N/A'}</td>
                            <td class="px-4 py-3">
                                <button onclick="viewCompanyDetails('${company.name}', ${companyId})" class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-eye mr-1"></i>Ver
                                </button>
                            </td>
                        </tr>
                    `;
                }).join('');
            }
            
            displayReviews(data) {
                const container = document.getElementById('reviewsContainer');
                const loadingState = document.getElementById('loadingState');
                const emptyState = document.getElementById('emptyState');
                
                loadingState.classList.add('hidden');
                
                // Verificar se data tem estrutura de paginação ou é array direto
                const reviews = data.data || data;
                
                if (reviews.length === 0) {
                    emptyState.classList.remove('hidden');
                    container.classList.add('hidden');
                    return;
                }
                
                emptyState.classList.add('hidden');
                container.classList.remove('hidden');
                
                container.innerHTML = reviews.map(review => this.createReviewCard(review)).join('');
                
                // Atualizar paginação se disponível
                if (data.last_page) {
                    this.updatePagination(data);
                }
            }
            
            createReviewCard(review) {
                const isPositive = review.is_positive;
                const ratingClass = isPositive ? 'rating-positive' : 'rating-negative';
                const typeText = isPositive ? 'Positiva' : 'Negativa';
                const typeIcon = isPositive ? 'fa-thumbs-up' : 'fa-exclamation-triangle';
                
                return `
                    <div class="p-6 border-b border-gray-200 hover:bg-gray-50 transition-colors fade-in">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 ${ratingClass} rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas ${typeIcon} text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">${review.company.name}</h3>
                                        <p class="text-sm text-gray-600">${typeText} • ${review.created_at}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400 mr-3">
                                        ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}
                                    </div>
                                    <span class="text-lg font-semibold text-gray-800">${review.rating}/5</span>
                                </div>
                                
                                <div class="flex items-center mb-3">
                                    <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium mr-3">
                                        <i class="fab fa-whatsapp mr-1"></i>
                                        ${review.whatsapp}
                                    </div>
                                    <button onclick="contactWhatsApp('${review.whatsapp}')" class="bg-green-500 text-white px-3 py-1 rounded-full text-sm hover:bg-green-600 transition-colors">
                                        <i class="fab fa-whatsapp mr-1"></i>
                                        Contatar
                                    </button>
                                </div>
                                
                                ${review.comment ? `
                                    <div class="bg-gray-50 p-3 rounded-lg">
                                        <p class="text-gray-700 italic">"${review.comment}"</p>
                                    </div>
                                ` : ''}
                            </div>
                            
                            <div class="flex flex-col space-y-2 ml-4">
                                <button onclick="markAsProcessed(${review.id})" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-check mr-1"></i>
                                    Processar
                                </button>
                                <button onclick="deleteReview(${review.id})" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition-colors">
                                    <i class="fas fa-trash mr-1"></i>
                                    Excluir
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            updateStats(data) {
                // Verificar se data tem estrutura de paginação ou é array direto
                const reviews = data.data || data;
                const total = data.total || reviews.length;
                
                const positive = reviews.filter(r => r.is_positive).length;
                const negative = reviews.filter(r => !r.is_positive).length;
                const average = reviews.length > 0 ? 
                    (reviews.reduce((sum, r) => sum + r.rating, 0) / reviews.length).toFixed(1) : 0;
                
                document.getElementById('totalReviews').textContent = total;
                document.getElementById('positiveReviews').textContent = positive;
                document.getElementById('negativeReviews').textContent = negative;
                document.getElementById('averageRating').textContent = average;
            }
            
            updatePagination(data) {
                const container = document.getElementById('paginationContainer');
                if (data.last_page <= 1) {
                    container.classList.add('hidden');
                    return;
                }
                
                container.classList.remove('hidden');
                
                let pagination = '<div class="flex items-center justify-between">';
                pagination += `<span class="text-sm text-gray-600">Mostrando ${data.from || 0} a ${data.to || 0} de ${data.total} avaliações</span>`;
                
                pagination += '<div class="flex space-x-2">';
                
                // Previous button
                if (data.current_page > 1) {
                    pagination += `<button onclick="reviewsPanel.goToPage(${data.current_page - 1})" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors">Anterior</button>`;
                }
                
                // Page numbers
                for (let i = Math.max(1, data.current_page - 2); i <= Math.min(data.last_page, data.current_page + 2); i++) {
                    const activeClass = i === data.current_page ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300';
                    pagination += `<button onclick="reviewsPanel.goToPage(${i})" class="px-3 py-1 ${activeClass} rounded transition-colors">${i}</button>`;
                }
                
                // Next button
                if (data.current_page < data.last_page) {
                    pagination += `<button onclick="reviewsPanel.goToPage(${data.current_page + 1})" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors">Próximo</button>`;
                }
                
                pagination += '</div></div>';
                container.innerHTML = pagination;
            }
            
            goToPage(page) {
                this.currentPage = page;
                this.loadReviews();
            }
            
            bindEvents() {
                document.getElementById('companyFilter').addEventListener('change', () => this.applyFilters());
                document.getElementById('typeFilter').addEventListener('change', () => this.applyFilters());
                document.getElementById('ratingFilter').addEventListener('change', () => this.applyFilters());
                document.getElementById('dateFilter').addEventListener('change', () => this.applyFilters());
            }
            
            applyFilters() {
                this.filters = {
                    company_id: document.getElementById('companyFilter').value,
                    type: document.getElementById('typeFilter').value,
                    rating: document.getElementById('ratingFilter').value,
                    date: document.getElementById('dateFilter').value
                };
                
                this.currentPage = 1;
                this.loadReviews();
            }
            
            clearFilters() {
                document.getElementById('companyFilter').value = '';
                document.getElementById('typeFilter').value = '';
                document.getElementById('ratingFilter').value = '';
                document.getElementById('dateFilter').value = '';
                
                this.filters = {
                    company_id: '',
                    type: '',
                    rating: '',
                    date: ''
                };
                
                this.currentPage = 1;
                this.loadReviews();
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
        let reviewsPanel;
        
        function applyFilters() {
            reviewsPanel.applyFilters();
        }
        
        function clearFilters() {
            reviewsPanel.clearFilters();
        }
        
        function refreshReviews() {
            reviewsPanel.loadReviews();
        }
        
        function contactWhatsApp(whatsapp) {
            const cleanNumber = whatsapp.replace(/[^0-9]/g, '');
            window.open(`https://wa.me/${cleanNumber}`, '_blank');
        }
        
        async function exportContacts(button) {
            try {
                const companyId = document.getElementById('companyFilter').value;
                if (!companyId) {
                    alert('Selecione uma empresa para exportar os contatos');
                    return;
                }
                
                // Mostrar feedback de carregamento
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exportando...';
                button.disabled = true;
                
                const response = await fetch(`/api/companies/${companyId}/contacts`);
                const result = await response.json();
                
                if (result.success && result.data.contacts.length > 0) {
                    // Criar arquivo CSV
                    const csvContent = [
                        'WhatsApp,Nota,Comentário,Data',
                        ...result.data.contacts.map(contact => 
                            `"${contact.whatsapp}","${contact.rating}","${contact.comment || ''}","${contact.created_at}"`
                        )
                    ].join('\n');
                    
                    // Download do arquivo
                    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `contatos_${result.data.company.replace(/[^a-zA-Z0-9]/g, '_')}.csv`;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                    
                    alert(`Arquivo exportado com sucesso! ${result.data.contacts.length} contatos exportados.`);
                } else {
                    alert('Nenhum contato encontrado para esta empresa');
                }
            } catch (error) {
                console.error('Erro ao exportar contatos:', error);
                alert('Erro ao exportar contatos: ' + error.message);
            } finally {
                // Restaurar botão
                button.innerHTML = '<i class="fas fa-download mr-2"></i>Exportar Contatos';
                button.disabled = false;
            }
        }
        
        function markAsProcessed(reviewId) {
            reviewsPanel.showNotification('Avaliação marcada como processada!', 'success');
        }
        
        function deleteReview(reviewId) {
            if (confirm('Tem certeza que deseja excluir esta avaliação?')) {
                reviewsPanel.showNotification('Avaliação excluída!', 'success');
            }
        }
        
        function exportAllContacts() {
            reviewsPanel.showNotification('Exportando contatos...', 'info');
        }
        
        async function exportCompanyData() {
            try {
                // Mostrar feedback de carregamento
                reviewsPanel.showNotification('Exportando dados das empresas...', 'info');
                
                // Buscar todas as avaliações para calcular estatísticas por empresa
                const response = await fetch('/api/reviews');
                const result = await response.json();
                
                if (result.success && result.data.data) {
                    const reviews = result.data.data;
                    
                    // Agrupar por empresa
                    const companyStats = {};
                    reviews.forEach(review => {
                        if (!companyStats[review.company.id]) {
                            companyStats[review.company.id] = {
                                name: review.company.name,
                                total: 0,
                                positive: 0,
                                negative: 0,
                                ratings: []
                            };
                        }
                        
                        companyStats[review.company.id].total++;
                        if (review.is_positive) {
                            companyStats[review.company.id].positive++;
                        } else {
                            companyStats[review.company.id].negative++;
                        }
                        companyStats[review.company.id].ratings.push(review.rating);
                    });
                    
                    // Criar arquivo CSV
                    const csvContent = [
                        'Empresa,Total Avaliações,Positivas,Negativas,Média',
                        ...Object.values(companyStats).map(company => {
                            const average = company.ratings.length > 0 ? 
                                (company.ratings.reduce((sum, rating) => sum + rating, 0) / company.ratings.length).toFixed(1) : '0.0';
                            return `"${company.name}","${company.total}","${company.positive}","${company.negative}","${average}"`;
                        })
                    ].join('\n');
                    
                    // Download do arquivo
                    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'performance_empresas.csv';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                    
                    reviewsPanel.showNotification('Dados exportados com sucesso!', 'success');
                } else {
                    reviewsPanel.showNotification('Nenhum dado encontrado para exportar', 'warning');
                }
            } catch (error) {
                console.error('Erro ao exportar dados:', error);
                reviewsPanel.showNotification('Erro ao exportar dados', 'error');
            }
        }
        
        function viewCompanyDetails(companyName, companyId) {
            // Filtrar avaliações pela empresa selecionada usando o ID
            const companySelect = document.getElementById('companyFilter');
            
            // Definir o valor do select usando o ID da empresa
            companySelect.value = companyId;
            
            // Aplicar filtros para mostrar apenas avaliações desta empresa
            reviewsPanel.applyFilters();
            reviewsPanel.showNotification(`Mostrando avaliações de ${companyName}`, 'success');
        }
        
        function updateChartPeriod(period) {
            reviewsPanel.updateChartPeriod(period);
        }
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            reviewsPanel = new ReviewsPanel();
        });
    </script>
</body>
</html>