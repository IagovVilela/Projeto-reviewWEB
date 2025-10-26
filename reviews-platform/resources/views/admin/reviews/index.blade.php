@extends('layouts.admin')

@section('title', __('reviews.title') . ' - Reviews Platform')

@section('page-title', __('reviews.dashboard_title'))
@section('page-description', __('reviews.dashboard_description'))

@section('header-actions')
    <button onclick="exportContacts(this)" class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-600 transition-colors">
        <i class="fas fa-download mr-2"></i>
        {{ __('reviews.export_contacts') }}
    </button>
    <button onclick="refreshReviews()" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-sync-alt mr-2"></i>
        {{ __('reviews.update') }}
    </button>
@endsection

@section('styles')
    <style>
        .rating-positive {
            background: #10b981;
        }
        
        .rating-negative {
            background: #ef4444;
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
            opacity: 0;
            animation: chartFadeIn 0.8s ease-out forwards;
        }
        
        @keyframes chartFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .chart-container canvas {
            animation: chartScale 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            animation-delay: 0.2s;
            transform: scale(0.95);
        }
        
        @keyframes chartScale {
            to {
                transform: scale(1);
            }
        }
        
        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }
        
        .chart-period-btn {
            transition: var(--transition-smooth);
        }
        
        .chart-period-btn.active {
            background: var(--primary-color);
            color: white;
            transform: scale(1.05);
        }
        
        .chart-period-btn:hover:not(.active) {
            background: rgba(139, 92, 246, 0.1);
            color: var(--primary-color);
        }
        
        .trend-up {
            color: #10b981;
        }
        
        .trend-down {
            color: #ef4444;
        }
    </style>
@endsection

@section('content')
    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('reviews.filters') }}</h3>
        <div class="flex flex-wrap items-center gap-4">
            <!-- Company Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('reviews.company') }}</label>
                <select id="companyFilter" class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">{{ __('reviews.all_companies') }}</option>
                </select>
            </div>
            
            <!-- Type Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('reviews.type') }}</label>
                <select id="typeFilter" class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">{{ __('reviews.all_types') }}</option>
                    <option value="positive">{{ __('reviews.positive_ratings') }}</option>
                    <option value="negative">{{ __('reviews.negative_ratings') }}</option>
                </select>
            </div>
            
            <!-- Rating Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('reviews.rating') }}</label>
                <select id="ratingFilter" class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">{{ __('reviews.all_ratings') }}</option>
                    <option value="5">5 {{ __('reviews.rating_label') }}</option>
                    <option value="4">4 {{ __('reviews.rating_label') }}</option>
                    <option value="3">3 {{ __('reviews.rating_label') }}</option>
                    <option value="2">2 {{ __('reviews.rating_label') }}</option>
                    <option value="1">1 {{ __('reviews.rating_label_singular') }}</option>
                </select>
            </div>
            
            <!-- Date Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('reviews.period') }}</label>
                <select id="dateFilter" class="px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">{{ __('reviews.all_periods') }}</option>
                    <option value="today">{{ __('reviews.today') }}</option>
                    <option value="week">{{ __('reviews.this_week') }}</option>
                    <option value="month">{{ __('reviews.this_month') }}</option>
                </select>
            </div>
            
            <div class="flex items-end space-x-2">
                <button onclick="applyFilters()" class="btn-primary text-white px-4 py-2 rounded-lg font-medium">
                    <i class="fas fa-filter mr-2"></i>
                    {{ __('reviews.apply') }}
                </button>
                <button onclick="clearFilters()" class="btn-secondary text-white px-4 py-2 rounded-lg font-medium">
                    <i class="fas fa-times mr-2"></i>
                    {{ __('reviews.clear') }}
                </button>
            </div>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <!-- Total Reviews -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 card-hover">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-star text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('reviews.total_reviews') }}</p>
                    <p class="text-2xl font-bold text-gray-800 dark:text-gray-100" id="totalReviews">0</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        <i class="fas fa-arrow-up trend-up"></i> +12% vs mês anterior
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Positive Reviews -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 card-hover">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-thumbs-up text-green-600 dark:text-green-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('reviews.positive') }}</p>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400" id="positiveReviews">0</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        <i class="fas fa-arrow-up trend-up"></i> +8% vs mês anterior
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Negative Reviews -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 card-hover">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-4 pulse-alert">
                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('reviews.negative') }}</p>
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400" id="negativeReviews">0</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        <i class="fas fa-arrow-down trend-down"></i> -5% vs mês anterior
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Average Rating -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 card-hover">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-chart-line text-yellow-600 dark:text-yellow-400 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('reviews.average') }}</p>
                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400" id="averageRating">0.0</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        <i class="fas fa-arrow-up trend-up"></i> +0.3 vs mês anterior
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Reviews Over Time Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 card-hover">
                <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ __('reviews.reviews_over_time') }}</h3>
                <div class="flex space-x-2">
                    <button onclick="updateChartPeriod('7d', this)" class="chart-period-btn active px-3 py-1 text-xs rounded-full bg-purple-500 text-white">{{ __('reviews.days_7') }}</button>
                    <button onclick="updateChartPeriod('30d', this)" class="chart-period-btn px-3 py-1 text-xs rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">{{ __('reviews.days_30') }}</button>
                    <button onclick="updateChartPeriod('90d', this)" class="chart-period-btn px-3 py-1 text-xs rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">{{ __('reviews.days_90') }}</button>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="reviewsOverTimeChart"></canvas>
            </div>
        </div>
        
        <!-- Rating Distribution Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 card-hover">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ __('reviews.rating_distribution') }}</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('reviews.positivas') }}</span>
                    <div class="w-3 h-3 bg-red-500 rounded-full ml-4"></div>
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('reviews.negativas') }}</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="ratingDistributionChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Company Performance Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700 card-hover mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ __('reviews.company_performance') }}</h3>
            <button onclick="exportCompanyData()" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-600 transition-colors">
                <i class="fas fa-download mr-2"></i>
                {{ __('reviews.export_data') }}
            </button>
        </div>
        <div class="table-container">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-900 sticky top-0">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">{{ __('reviews.empresa') }}</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">{{ __('reviews.total') }}</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">{{ __('reviews.positivas') }}</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">{{ __('reviews.negativas') }}</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">{{ __('reviews.media') }}</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">{{ __('reviews.ultima') }}</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">{{ __('reviews.acoes') }}</th>
                    </tr>
                </thead>
                <tbody id="companyPerformanceTable">
                    <!-- Data will be loaded here -->
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Reviews List -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ __('reviews.reviews_list') }}</h2>
            <p class="text-gray-600 dark:text-gray-400 text-sm">{{ __('reviews.last_reviews') }}</p>
        </div>
        
        <!-- Loading State - Skeleton Screens -->
        <div id="loadingState" class="space-y-4">
            <!-- Skeleton Review Card 1 -->
            <div class="skeleton-card">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center flex-1">
                        <div class="skeleton-avatar"></div>
                        <div class="flex-1">
                            <div class="skeleton-line w-1-2"></div>
                            <div class="skeleton-line w-1-4"></div>
                        </div>
                    </div>
                    <div class="w-24">
                        <div class="skeleton-line w-full"></div>
                    </div>
                </div>
                <div class="skeleton-line w-full"></div>
                <div class="skeleton-line w-3-4"></div>
            </div>
            
            <!-- Skeleton Review Card 2 -->
            <div class="skeleton-card">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center flex-1">
                        <div class="skeleton-avatar"></div>
                        <div class="flex-1">
                            <div class="skeleton-line w-1-2"></div>
                            <div class="skeleton-line w-1-4"></div>
                        </div>
                    </div>
                    <div class="w-24">
                        <div class="skeleton-line w-full"></div>
                    </div>
                </div>
                <div class="skeleton-line w-full"></div>
                <div class="skeleton-line w-1-2"></div>
            </div>
            
            <!-- Skeleton Review Card 3 -->
            <div class="skeleton-card">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center flex-1">
                        <div class="skeleton-avatar"></div>
                        <div class="flex-1">
                            <div class="skeleton-line w-1-2"></div>
                            <div class="skeleton-line w-1-4"></div>
                        </div>
                    </div>
                    <div class="w-24">
                        <div class="skeleton-line w-full"></div>
                    </div>
                </div>
                <div class="skeleton-line w-full"></div>
                <div class="skeleton-line w-3-4"></div>
                <div class="skeleton-line w-1-2"></div>
            </div>
<<<<<<< HEAD
=======
            <p class="text-gray-600 dark:text-gray-400">{{ __('reviews.loading') }}</p>
>>>>>>> 240332460b98bf1548c6092d766c489f450e06aa
        </div>
        
        <!-- Reviews Container -->
        <div id="reviewsContainer" class="hidden">
            <!-- Reviews will be loaded here -->
        </div>
        
        <!-- Empty State -->
        <div id="emptyState" class="hidden p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                <i class="fas fa-star text-gray-400 dark:text-gray-500 text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">{{ __('reviews.no_reviews') }}</h3>
            <p class="text-gray-600 dark:text-gray-400">{{ __('reviews.no_reviews_desc') }}</p>
        </div>
        
        <!-- Pagination -->
        <div id="paginationContainer" class="hidden p-6 border-t border-gray-200 dark:border-gray-700">
            <!-- Pagination will be loaded here -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        // Translations for JavaScript
        const translations = {
            pt_BR: {
                monday: 'Seg', tuesday: 'Ter', wednesday: 'Qua', thursday: 'Qui', 
                friday: 'Sex', saturday: 'Sáb', sunday: 'Dom',
                positivas: 'Positivas', negativas: 'Negativas'
            },
            en_US: {
                monday: 'Mon', tuesday: 'Tue', wednesday: 'Wed', thursday: 'Thu',
                friday: 'Fri', saturday: 'Sat', sunday: 'Sun',
                positivas: 'Positive', negativas: 'Negative'
            }
        };
        
        const currentLang = '{{ app()->getLocale() }}';
        const t = translations[currentLang] || translations.pt_BR;
        
        // Função para formatar data
        function formatDate(dateString) {
            if (!dateString) return '';
            
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString;
            
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            
            return `${day}/${month}/${year} ${hours}:${minutes}`;
        }
        
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
                this.chartPeriod = 7; // Default to 7 days
                this.allReviews = []; // Store all reviews for chart updates
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
                        // Store all reviews for chart updates - result.data is paginated, result.data.data has the reviews
                        const reviews = result.data.data || result.data;
                        this.allReviews = reviews;
                        
                        this.displayReviews(result.data);
                        this.updateStats(result.data);
                        this.updateCompanyPerformanceTable(result.data);
                        this.updateChartsWithRealData(reviews);
                    } else {
                        this.showError('Erro ao carregar avaliações');
                    }
                } catch (error) {
                    console.error('Erro ao carregar avaliações:', error);
                    this.showError('Erro ao carregar avaliações');
                }
            }
            
            initializeCharts() {
                // Reviews Over Time Chart with sample data
                const reviewsOverTimeCtx = document.getElementById('reviewsOverTimeChart').getContext('2d');
                this.charts.reviewsOverTime = new Chart(reviewsOverTimeCtx, {
                    type: 'line',
                    data: {
                        labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                        datasets: [{
                            label: 'Positivas',
                            data: [12, 19, 15, 21, 18, 25, 22], // Sample data
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2
                        }, {
                            label: 'Negativas',
                            data: [3, 5, 2, 4, 3, 6, 4], // Sample data
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            pointBackgroundColor: '#ef4444',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 1500,
                            easing: 'easeInOutQuart',
                            delay: (context) => {
                                let delay = 0;
                                if (context.type === 'data' && context.mode === 'default') {
                                    delay = context.dataIndex * 100;
                                }
                                return delay;
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    padding: 15,
                                    font: {
                                        size: 13
                                    }
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false,
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 12,
                                cornerRadius: 8
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                ticks: {
                                    precision: 0
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        },
                        interaction: {
                            mode: 'nearest',
                            axis: 'x',
                            intersect: false
                        }
                    }
                });
                
                // Rating Distribution Chart with sample data
                const ratingDistributionCtx = document.getElementById('ratingDistributionChart').getContext('2d');
                this.charts.ratingDistribution = new Chart(ratingDistributionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['5★', '4★', '3★', '2★', '1★'],
                        datasets: [{
                            data: [45, 30, 15, 7, 3], // Sample data
                            backgroundColor: [
                                '#10b981',
                                '#34d399',
                                '#fbbf24',
                                '#f59e0b',
                                '#ef4444'
                            ],
                            borderWidth: 3,
                            borderColor: '#ffffff',
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true,
                                    font: {
                                        size: 13
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 12,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += context.parsed + ' avaliações';
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            }
            
            updateChartsWithRealData(reviews) {
                console.log('updateChartsWithRealData chamado', reviews);
                if (!reviews || reviews.length === 0) {
                    console.log('Sem reviews para atualizar gráficos');
                    return;
                }
                
                // Update rating distribution chart
                const ratingCounts = [0, 0, 0, 0, 0];
                reviews.forEach(review => {
                    if (review.rating >= 1 && review.rating <= 5) {
                        ratingCounts[5 - review.rating]++;
                    }
                });
                
                console.log('Rating counts:', ratingCounts);
                
                if (this.charts.ratingDistribution) {
                    this.charts.ratingDistribution.data.datasets[0].data = ratingCounts;
                    this.charts.ratingDistribution.update();
                }
                
                // Update reviews over time chart
                this.updateReviewsOverTimeChart(reviews);
            }
            
            updateReviewsOverTimeChart(reviews) {
                if (!reviews || reviews.length === 0 || !this.charts.reviewsOverTime) return;
                
                const today = new Date();
                const dateRanges = [];
                const labels = [];
                const positiveData = [];
                const negativeData = [];
                
                // Create array of dates based on period
                const period = this.chartPeriod;
                
                if (period === 7) {
                    // Last 7 days - show day names
                    for (let i = period - 1; i >= 0; i--) {
                        const date = new Date(today);
                        date.setDate(date.getDate() - i);
                        date.setHours(0, 0, 0, 0);
                        dateRanges.push(date);
                        
                        const dayNames = [
                            t.sunday, t.monday, t.tuesday, t.wednesday, t.thursday, t.friday, t.saturday
                        ];
                        labels.push(dayNames[date.getDay()]);
                    }
                } else if (period === 30) {
                    // Last 30 days - show every 5 days
                    for (let i = period - 1; i >= 0; i -= 5) {
                        const date = new Date(today);
                        date.setDate(date.getDate() - i);
                        date.setHours(0, 0, 0, 0);
                        dateRanges.push(date);
                        
                        labels.push(`${date.getDate()}/${date.getMonth() + 1}`);
                    }
                } else if (period === 90) {
                    // Last 90 days - show every 15 days
                    for (let i = period - 1; i >= 0; i -= 15) {
                        const date = new Date(today);
                        date.setDate(date.getDate() - i);
                        date.setHours(0, 0, 0, 0);
                        dateRanges.push(date);
                        
                        labels.push(`${date.getDate()}/${date.getMonth() + 1}`);
                    }
                }
                
                // Count reviews for each date range
                dateRanges.forEach((date, index) => {
                    let positiveCount = 0;
                    let negativeCount = 0;
                    
                    // Get the range for this data point
                    const nextDate = dateRanges[index + 1] || new Date(today.getTime() + 86400000);
                    
                    reviews.forEach(review => {
                        try {
                            const reviewDate = new Date(review.created_at);
                            if (isNaN(reviewDate.getTime())) {
                                console.error('Data inválida:', review.created_at);
                                return;
                            }
                            reviewDate.setHours(0, 0, 0, 0);
                            
                            // For 7 days, match exact day. For others, match range
                            if (period === 7) {
                                // Compare by date string to avoid timezone issues
                                const reviewDateStr = reviewDate.toISOString().split('T')[0];
                                const rangeDateStr = date.toISOString().split('T')[0];
                                
                                if (reviewDateStr === rangeDateStr) {
                                    if (review.is_positive) {
                                        positiveCount++;
                                    } else {
                                        negativeCount++;
                                    }
                                }
                            } else {
                                if (reviewDate >= date && reviewDate < nextDate) {
                                    if (review.is_positive) {
                                        positiveCount++;
                                    } else {
                                        negativeCount++;
                                    }
                                }
                            }
                        } catch (error) {
                            console.error('Erro ao processar review:', error, review);
                        }
                    });
                    
                    positiveData.push(positiveCount);
                    negativeData.push(negativeCount);
                });
                
                // Update chart
                this.charts.reviewsOverTime.data.labels = labels;
                this.charts.reviewsOverTime.data.datasets[0].data = positiveData;
                this.charts.reviewsOverTime.data.datasets[1].data = negativeData;
                this.charts.reviewsOverTime.update('active');
            }
            
            changeChartPeriod(period) {
                this.chartPeriod = period;
                this.updateReviewsOverTimeChart(this.allReviews);
            }
            
            displayReviews(data) {
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
                
                container.innerHTML = reviews.map(review => this.createReviewCard(review)).join('');
                
                if (data.last_page) {
                    this.updatePagination(data);
                }
            }
            
            createReviewCard(review) {
                const isPositive = review.is_positive;
                const ratingClass = isPositive ? 'rating-positive' : 'rating-negative';
                const typeText = isPositive ? '{{ __('reviews.positive') }}' : '{{ __('reviews.negative') }}';
                const typeIcon = isPositive ? 'fa-thumbs-up' : 'fa-exclamation-triangle';
                
                return `
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors fade-in">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 ${ratingClass} rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas ${typeIcon} text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800 dark:text-gray-100">${review.company.name}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">${typeText} • ${formatDate(review.created_at)}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center mb-3">
                                    <div class="flex text-yellow-400 mr-3">
                                        ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}
                                    </div>
                                    <span class="text-lg font-semibold text-gray-800 dark:text-gray-100">${review.rating}/5</span>
                                </div>
                                
                                <div class="flex items-center mb-3">
                                    <div class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-3 py-1 rounded-full text-sm font-medium mr-3">
                                        <i class="fab fa-whatsapp mr-1"></i>
                                        ${review.whatsapp}
                                    </div>
                                    <button onclick="contactWhatsApp('${review.whatsapp}')" class="bg-green-500 text-white px-3 py-1 rounded-full text-sm hover:bg-green-600 transition-colors">
                                        <i class="fab fa-whatsapp mr-1"></i>
                                        {{ __('reviews.contact') }}
                                    </button>
                                </div>
                                
                                ${review.comment ? `
                                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                                        <p class="text-gray-700 dark:text-gray-300 italic">"${review.comment}"</p>
                                    </div>
                                ` : ''}
                            </div>
                            
                            <div class="flex flex-col space-y-2 ml-4">
                                <button onclick="markAsProcessed(${review.id})" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-check mr-1"></i>
                                    {{ __('reviews.process') }}
                                </button>
                                <button onclick="deleteReview(${review.id})" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition-colors">
                                    <i class="fas fa-trash mr-1"></i>
                                    {{ __('reviews.delete') }}
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            updateStats(data) {
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
            
            updateCompanyPerformanceTable(data) {
                const tbody = document.getElementById('companyPerformanceTable');
                const reviews = data.data || data;
                
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
                
                tbody.innerHTML = Object.entries(companyStats).map(([companyId, company]) => {
                    const average = company.ratings.length > 0 ? 
                        (company.ratings.reduce((sum, rating) => sum + rating, 0) / company.ratings.length).toFixed(1) : '0.0';
                    
                    return `
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">${company.name}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">${company.total}</td>
                            <td class="px-4 py-3 text-green-600 dark:text-green-400 font-medium">${company.positive}</td>
                            <td class="px-4 py-3 text-red-600 dark:text-red-400 font-medium">${company.negative}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">${average}</td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 text-sm">${company.lastReview ? formatDate(company.lastReview) : 'N/A'}</td>
                            <td class="px-4 py-3">
                                <button onclick="viewCompanyDetails('${company.name}', ${companyId})" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm">
                                    <i class="fas fa-eye mr-1"></i>{{ __('reviews.view') }}
                                </button>
                            </td>
                        </tr>
                    `;
                }).join('');
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
                
                if (data.current_page > 1) {
                    pagination += `<button onclick="reviewsPanel.goToPage(${data.current_page - 1})" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors">Anterior</button>`;
                }
                
                for (let i = Math.max(1, data.current_page - 2); i <= Math.min(data.last_page, data.current_page + 2); i++) {
                    const activeClass = i === data.current_page ? 'bg-purple-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300';
                    pagination += `<button onclick="reviewsPanel.goToPage(${i})" class="px-3 py-1 ${activeClass} rounded transition-colors">${i}</button>`;
                }
                
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
                showNotification(message, 'error');
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
            if (!button) return;
            
            const companyId = document.getElementById('companyFilter').value;
            if (!companyId) {
                showNotification('Selecione uma empresa para exportar os contatos', 'warning');
                return;
            }
            
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exportando...';
            button.disabled = true;
            
            try {
                const response = await fetch(`/api/companies/${companyId}/contacts`);
                const result = await response.json();
                
                if (result.success && result.data.contacts.length > 0) {
                    const csvContent = [
                        'WhatsApp,Nota,Comentário,Data',
                        ...result.data.contacts.map(contact => 
                            `"${contact.whatsapp}","${contact.rating}","${contact.comment || ''}","${formatDate(contact.created_at)}"`
                        )
                    ].join('\n');
                    
                    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `contatos_${result.data.company.replace(/[^a-zA-Z0-9]/g, '_')}.csv`;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                    
                    showNotification(`Arquivo exportado com sucesso! ${result.data.contacts.length} contatos.`, 'success');
                } else {
                    showNotification('Nenhum contato encontrado para esta empresa', 'warning');
                }
            } catch (error) {
                console.error('Erro:', error);
                showNotification('Erro ao exportar contatos', 'error');
            } finally {
                // Safely restore button state
                if (button && originalText) {
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            }
        }
        
        function markAsProcessed(reviewId) {
            showNotification('Avaliação marcada como processada!', 'success');
        }
        
        function deleteReview(reviewId) {
            if (confirm('Tem certeza que deseja excluir esta avaliação?')) {
                showNotification('Avaliação excluída!', 'success');
            }
        }
        
        async function exportCompanyData() {
            try {
                showNotification('{{ __('reviews.export_preparing') }}', 'info');
                
                // Coletar todos os dados de reviews para gerar estatísticas completas
                const response = await fetch('/api/reviews');
                const result = await response.json();
                
                if (!result.success || !result.data) {
                    showNotification('{{ __('reviews.export_error') }}', 'error');
                    return;
                }
                
                const reviews = result.data.data || result.data;
                
                // Agrupar dados por empresa
                const companyStats = {};
                reviews.forEach(review => {
                    if (!companyStats[review.company.id]) {
                        companyStats[review.company.id] = {
                            nome: review.company.name,
                            total: 0,
                            positivas: 0,
                            negativas: 0,
                            ratings: [],
                            lastReview: null
                        };
                    }
                    
                    companyStats[review.company.id].total++;
                    if (review.is_positive) {
                        companyStats[review.company.id].positivas++;
                    } else {
                        companyStats[review.company.id].negativas++;
                    }
                    companyStats[review.company.id].ratings.push(review.rating);
                    
                    if (!companyStats[review.company.id].lastReview || 
                        new Date(review.created_at) > new Date(companyStats[review.company.id].lastReview)) {
                        companyStats[review.company.id].lastReview = review.created_at;
                    }
                });
                
                // Preparar dados para Excel
                const excelData = [];
                
                // Adicionar cabeçalho
                excelData.push([
                    '{{ __('reviews.empresa') }}',
                    '{{ __('reviews.total') }}',
                    '{{ __('reviews.positivas') }}',
                    '{{ __('reviews.negativas') }}',
                    '{{ __('reviews.media') }}',
                    '{{ __('reviews.ultima') }}'
                ]);
                
                // Adicionar dados das empresas
                Object.values(companyStats).forEach(company => {
                    const average = company.ratings.length > 0 ? 
                        (company.ratings.reduce((sum, rating) => sum + rating, 0) / company.ratings.length).toFixed(2) : '0.00';
                    
                    excelData.push([
                        company.nome,
                        company.total,
                        company.positivas,
                        company.negativas,
                        average,
                        company.lastReview ? formatDate(company.lastReview) : 'N/A'
                    ]);
                });
                
                // Adicionar linha de totais
                const totalReviews = Object.values(companyStats).reduce((sum, c) => sum + c.total, 0);
                const totalPositivas = Object.values(companyStats).reduce((sum, c) => sum + c.positivas, 0);
                const totalNegativas = Object.values(companyStats).reduce((sum, c) => sum + c.negativas, 0);
                const allRatings = Object.values(companyStats).flatMap(c => c.ratings);
                const overallAverage = allRatings.length > 0 ? 
                    (allRatings.reduce((sum, r) => sum + r, 0) / allRatings.length).toFixed(2) : '0.00';
                
                excelData.push([]);
                excelData.push([
                    'TOTAL',
                    totalReviews,
                    totalPositivas,
                    totalNegativas,
                    overallAverage,
                    ''
                ]);
                
                // Criar workbook e worksheet
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(excelData);
                
                // Definir larguras das colunas
                ws['!cols'] = [
                    { wch: 30 },  // Empresa
                    { wch: 10 },  // Total
                    { wch: 12 },  // Positivas
                    { wch: 12 },  // Negativas
                    { wch: 10 },  // Média
                    { wch: 20 }   // Última avaliação
                ];
                
                // Aplicar estilos ao cabeçalho (primeira linha)
                const headerStyle = {
                    font: { bold: true, color: { rgb: "FFFFFF" } },
                    fill: { fgColor: { rgb: "8B5CF6" } },
                    alignment: { horizontal: "center", vertical: "center" }
                };
                
                // Aplicar estilo à linha de totais
                const totalRowIndex = excelData.length - 1;
                const totalStyle = {
                    font: { bold: true },
                    fill: { fgColor: { rgb: "F3F4F6" } },
                    alignment: { horizontal: "center", vertical: "center" }
                };
                
                // Adicionar worksheet ao workbook
                XLSX.utils.book_append_sheet(wb, ws, "Desempenho das Empresas");
                
                // Gerar nome do arquivo com data
                const now = new Date();
                const dateStr = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;
                const fileName = `Avaliacoes_Empresas_${dateStr}.xlsx`;
                
                // Exportar arquivo
                XLSX.writeFile(wb, fileName);
                
                showNotification('{{ __('reviews.export_success') }}', 'success');
            } catch (error) {
                console.error('Erro ao exportar:', error);
                showNotification('{{ __('reviews.export_error') }}', 'error');
            }
        }
        
        function viewCompanyDetails(companyName, companyId) {
            document.getElementById('companyFilter').value = companyId;
            reviewsPanel.applyFilters();
            showNotification(`Mostrando avaliações de ${companyName}`, 'success');
        }
        
        function updateChartPeriod(periodStr, element) {
            if (!element || !reviewsPanel) return;
            
            // Parse period string (e.g., '7d' -> 7)
            const period = parseInt(periodStr);
            
            // Update button styles
            document.querySelectorAll('.chart-period-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-purple-500', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-600');
            });
            
            element.classList.add('active', 'bg-purple-500', 'text-white');
            element.classList.remove('bg-gray-200', 'text-gray-600');
            
            // Update chart with real data
            reviewsPanel.changeChartPeriod(period);
        }
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            reviewsPanel = new ReviewsPanel();
        });
    </script>
@endsection
