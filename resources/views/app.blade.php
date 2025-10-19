<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews Platform - Sistema de Avaliações</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/react@18/umd/react.development.js"></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
    <script src="https://unpkg.com/react-router-dom@6/dist/umd/react-router-dom.development.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .btn-primary {
            @apply bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-medium py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg;
        }
        
        .btn-secondary {
            @apply bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg;
        }
        
        .card {
            @apply bg-white rounded-2xl shadow-lg border border-gray-100 p-6 transition-all duration-300 hover:shadow-xl;
        }
        
        .input-field {
            @apply block w-full rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-all duration-300;
        }
        
        /* Animações personalizadas */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in-left {
            animation: slideInLeft 0.6s ease-out;
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .slide-in-right {
            animation: slideInRight 0.6s ease-out;
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .scale-in {
            animation: scaleIn 0.6s ease-out;
        }
        
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        
        /* Efeitos de hover personalizados */
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        /* Gradientes personalizados */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Scrollbar personalizada */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
    </style>
</head>
<body>
    <div id="root"></div>
    
    <script type="text/babel">
        const { useState, useEffect } = React;
        const { BrowserRouter, Routes, Route, Link, useParams, useNavigate } = ReactRouterDOM;
        
        // Componente Layout
        const Layout = ({ children }) => {
            const [sidebarOpen, setSidebarOpen] = useState(false);
            const location = window.location.pathname;
            
            const navigation = [
                { name: 'Dashboard', href: '/', icon: 'fas fa-home', active: location === '/' },
                { name: 'Empresas', href: '/companies', icon: 'fas fa-building', active: location === '/companies' },
                { name: 'Avaliações', href: '/reviews', icon: 'fas fa-comments', active: location === '/reviews' },
                { name: 'Avaliações Negativas', href: '/reviews', icon: 'fas fa-exclamation-triangle', active: location === '/reviews' },
            ];
            
            return (
                <div className="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
                    {/* Top Navigation Bar */}
                    <div className="bg-white/80 backdrop-blur-md border-b border-gray-200 shadow-lg">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div className="flex justify-between items-center h-16">
                                <div className="flex items-center space-x-4">
                                    <button
                                        type="button"
                                        className="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
                                        onClick={() => setSidebarOpen(true)}
                                    >
                                        <i className="fas fa-bars text-gray-600"></i>
                                    </button>
                                    <h1 className="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                        Reviews Platform
                                    </h1>
                            </div>
                                
                                <div className="flex items-center space-x-4">
                                    <button className="p-2 rounded-lg hover:bg-gray-100 transition-colors relative">
                                        <i className="fas fa-bell text-gray-600"></i>
                                        <span className="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                                    </button>
                                    <div className="flex items-center space-x-3">
                                        <div className="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <i className="fas fa-user text-white text-sm"></i>
                                        </div>
                                        <span className="text-sm font-medium text-gray-700">Admin</span>
                                        <button className="text-sm text-gray-500 hover:text-gray-700 transition-colors">
                                            Sair
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {/* Main Navigation */}
                    <div className="bg-white/90 backdrop-blur-sm border-b border-gray-200 shadow-sm">
                        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <nav className="flex space-x-8">
                                {navigation.map((item) => (
                                    <Link
                                        key={item.name}
                                        to={item.href}
                                        className={`group flex items-center px-4 py-4 text-sm font-medium border-b-2 transition-all duration-300 ${
                                            item.active
                                                ? 'border-blue-500 text-blue-600'
                                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                                        }`}
                                    >
                                        <i className={`${item.icon} mr-2 ${item.active ? 'text-blue-500' : 'text-gray-400'}`}></i>
                                        {item.name}
                                    </Link>
                                ))}
                            </nav>
                        </div>
                    </div>
                    
                    {/* Mobile Sidebar */}
                    <div className={`fixed inset-0 z-50 lg:hidden ${sidebarOpen ? 'block' : 'hidden'}`}>
                        <div className="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" onClick={() => setSidebarOpen(false)} />
                        <div className="fixed inset-y-0 left-0 flex w-80 flex-col bg-white shadow-2xl">
                            <div className="flex h-20 items-center justify-between px-6 border-b border-gray-100">
                                <div className="flex items-center space-x-3">
                                    <div className="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                        <i className="fas fa-shield-alt text-white text-lg"></i>
                            </div>
                                    <h1 className="text-xl font-bold text-gray-800">Reviews Platform</h1>
                                </div>
                                <button 
                                    onClick={() => setSidebarOpen(false)}
                                    className="p-2 rounded-lg hover:bg-gray-100 transition-colors"
                                >
                                    <i className="fas fa-times text-gray-500"></i>
                                </button>
                            </div>
                            <nav className="flex-1 px-4 py-6 space-y-2">
                                {navigation.map((item) => (
                                    <Link
                                        key={item.name}
                                        to={item.href}
                                        className={`group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ${
                                            item.active
                                                ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg'
                                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                                        }`}
                                    >
                                        <i className={`${item.icon} mr-3 text-lg ${item.active ? 'text-white' : 'text-gray-400'}`}></i>
                                        {item.name}
                                    </Link>
                                ))}
                            </nav>
                            <div className="p-4 border-t border-gray-100">
                                <div className="flex items-center space-x-3 p-3 rounded-xl bg-gray-50">
                                    <div className="w-8 h-8 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                                        <i className="fas fa-user text-white text-sm"></i>
                        </div>
                                    <div>
                                        <p className="text-sm font-medium text-gray-800">Admin</p>
                                        <p className="text-xs text-gray-500">admin@reviewsplatform.com</p>
                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        
                    {/* Main Content */}
                    <div className="min-h-screen">
                        <main>
                                {children}
                        </main>
                    </div>
                </div>
            );
        };
        
        // Componente Dashboard
        const Dashboard = () => {
            const [stats, setStats] = useState({
                totalCompanies: 24,
                totalReviews: 342,
                averageRating: 4.2,
                negativeReviews: 18,
                positiveReviews: 324,
                recentReviews: [
                    { id: 1, company: 'Restaurante XYZ', rating: 5, whatsapp: '(11) 99999-9999', date: 'Hoje 14:30', status: 'positive' },
                    { id: 2, company: 'Loja ABC', rating: 2, whatsapp: '(11) 88888-8888', date: 'Hoje 13:15', status: 'negative' },
                    { id: 3, company: 'Café 123', rating: 4, whatsapp: '(11) 77777-7777', date: 'Hoje 12:45', status: 'positive' },
                ]
            });
            
            const mainStatsCards = [
                {
                    title: 'Empresas',
                    subtitle: 'Total: 24 empresas',
                    icon: 'fas fa-building',
                    gradient: 'from-blue-500 via-blue-600 to-indigo-600',
                    bgPattern: 'bg-blue-50',
                    buttonText: 'Gerenciar Empresas',
                    buttonColor: 'bg-blue-600 hover:bg-blue-700',
                    href: '/companies',
                    stats: stats.totalCompanies,
                    change: '+3',
                    changeType: 'positive'
                },
                {
                    title: 'Avaliações',
                    subtitle: 'Total: 342 avaliações',
                    icon: 'fas fa-comments',
                    gradient: 'from-emerald-500 via-green-500 to-teal-600',
                    bgPattern: 'bg-green-50',
                    buttonText: 'Ver Avaliações',
                    buttonColor: 'bg-green-600 hover:bg-green-700',
                    href: '/reviews',
                    stats: stats.totalReviews,
                    change: '+28',
                    changeType: 'positive'
                },
                {
                    title: 'Negativas',
                    subtitle: '18 precisam atenção',
                    icon: 'fas fa-exclamation-triangle',
                    gradient: 'from-red-500 via-red-600 to-pink-600',
                    bgPattern: 'bg-red-50',
                    buttonText: 'Ver Negativas',
                    buttonColor: 'bg-red-600 hover:bg-red-700',
                    href: '/reviews',
                    stats: stats.negativeReviews,
                    change: '-2',
                    changeType: 'negative'
                }
            ];
            
            return (
                <div className="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
                    {/* Hero Section */}
                    <div className="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 rounded-3xl mx-4 mt-6 mb-8">
                        <div className="absolute inset-0 bg-black opacity-10"></div>
                        <div className="relative px-8 py-12">
                            <div className="text-center">
                                <div className="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl mb-6">
                                    <i className="fas fa-home text-white text-3xl"></i>
                        </div>
                                <h1 className="text-5xl font-bold text-white mb-4">Dashboard</h1>
                                <p className="text-xl text-blue-100 mb-8">Visão geral da plataforma de avaliações</p>
                                <div className="flex justify-center space-x-4">
                                    <div className="bg-white/20 backdrop-blur-sm rounded-xl px-6 py-3">
                                        <div className="text-white text-sm opacity-90">Avaliação Média</div>
                                        <div className="text-white text-2xl font-bold">{stats.averageRating} ⭐</div>
                        </div>
                                    <div className="bg-white/20 backdrop-blur-sm rounded-xl px-6 py-3">
                                        <div className="text-white text-sm opacity-90">Taxa de Satisfação</div>
                                        <div className="text-white text-2xl font-bold">94.7%</div>
                    </div>
                                        </div>
                                    </div>
                                                </div>
                        {/* Decorative Elements */}
                        <div className="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-32 translate-x-32"></div>
                        <div className="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full translate-y-24 -translate-x-24"></div>
                    </div>
                    
                    {/* Main Stats Cards */}
                    <div className="px-4 mb-8">
                        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            {mainStatsCards.map((card, index) => (
                                <div key={card.title} className={`${card.bgPattern} rounded-3xl p-8 shadow-2xl border border-white/50 backdrop-blur-sm relative overflow-hidden group hover:scale-105 transition-all duration-500`}>
                                    {/* Background Pattern */}
                                    <div className="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-white/20 to-transparent rounded-full -translate-y-16 translate-x-16"></div>
                                    <div className="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-white/20 to-transparent rounded-full translate-y-12 -translate-x-12"></div>
                                    
                                    <div className="relative z-10">
                                        <div className="flex items-center justify-between mb-6">
                                            <div className={`w-16 h-16 bg-gradient-to-r ${card.gradient} rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300`}>
                                                <i className={`${card.icon} text-white text-2xl`}></i>
                                            </div>
                                            <div className="text-right">
                                                <div className={`text-sm font-bold px-3 py-1 rounded-full ${
                                                    card.changeType === 'positive' ? 'bg-green-100 text-green-700' : 
                                                    card.changeType === 'negative' ? 'bg-red-100 text-red-700' : 
                                                    'bg-gray-100 text-gray-700'
                                                }`}>
                                                    {card.change}
                                                </div>
                                    </div>
                                        </div>
                                        
                                        <h3 className="text-2xl font-bold text-gray-800 mb-2">{card.title}</h3>
                                        <p className="text-gray-600 mb-6 text-lg">{card.subtitle}</p>
                                        
                                        <Link
                                            to={card.href}
                                            className={`${card.buttonColor} text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 inline-flex items-center`}
                                        >
                                            {card.buttonText}
                                            <i className="fas fa-arrow-right ml-2"></i>
                                        </Link>
                                </div>
                            </div>
                        ))}
                        </div>
                    </div>
                    
                    {/* Recent Reviews Section */}
                    <div className="px-4">
                        <div className="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
                            <div className="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-200">
                                <div className="flex items-center justify-between">
                                        <div className="flex items-center space-x-4">
                                        <div className="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                            <i className="fas fa-star text-white text-xl"></i>
                                                </div>
                                        <div>
                                            <h2 className="text-2xl font-bold text-gray-800">Avaliações Recentes</h2>
                                            <p className="text-gray-600">Últimas avaliações recebidas</p>
                                            </div>
                                            </div>
                                    <Link 
                                        to="/reviews"
                                        className="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1"
                                    >
                                        Ver Todas
                                    </Link>
                                </div>
                            </div>
                            
                            <div className="p-8">
                                <div className="space-y-6">
                                    {stats.recentReviews.map((review, index) => (
                                        <div key={review.id} className="group bg-gradient-to-r from-white to-gray-50 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-blue-200">
                                            <div className="flex items-center space-x-6">
                                                <div className={`w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg ${
                                                    review.status === 'positive' 
                                                        ? 'bg-gradient-to-r from-green-400 to-emerald-500' 
                                                        : 'bg-gradient-to-r from-red-400 to-pink-500'
                                                }`}>
                                                    <i className={`fas fa-star text-white text-xl`}></i>
                                                </div>
                                                
                                                <div className="flex-1">
                                                    <h4 className="text-xl font-bold text-gray-800 mb-1">{review.company}</h4>
                                                    <p className="text-gray-600 mb-2">WhatsApp: {review.whatsapp}</p>
                                            <div className="flex items-center space-x-2">
                                                    {[...Array(5)].map((_, i) => (
                                                            <i
                                                            key={i}
                                                                className={`fas fa-star text-lg ${
                                                                i < review.rating ? 'text-yellow-400' : 'text-gray-300'
                                                            }`}
                                                            ></i>
                                                    ))}
                                                        <span className="text-gray-500 ml-2">{review.rating}/5</span>
                                                </div>
                                            </div>
                                                
                                                <div className="text-right">
                                                    <div className={`px-4 py-2 rounded-xl font-semibold ${
                                                        review.status === 'positive' 
                                                            ? 'bg-green-100 text-green-700' 
                                                            : 'bg-red-100 text-red-700'
                                                    }`}>
                                                        {review.status === 'positive' ? '✅ Positiva' : '⚠️ Negativa'}
                                        </div>
                                                    <p className="text-gray-500 mt-2 font-medium">{review.date}</p>
                                                </div>
                                            </div>
                                        </div>
                                ))}
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            );
        };
        
        // Componente CompanyForm
        const CompanyForm = () => {
            const navigate = useNavigate();
            const [formData, setFormData] = useState({
                name: '',
                email: '',
                logo: null,
                backgroundImage: null,
                positiveThreshold: 4,
                googleUrl: ''
            });
            const [loading, setLoading] = useState(false);
            const [success, setSuccess] = useState(false);
            
            const handleInputChange = (e) => {
                const { name, value } = e.target;
                setFormData(prev => ({
                    ...prev,
                    [name]: value
                }));
            };
            
            const handleFileChange = (e) => {
                const { name, files } = e.target;
                setFormData(prev => ({
                    ...prev,
                    [name]: files[0]
                }));
            };
            
            const handleSubmit = async (e) => {
                e.preventDefault();
                setLoading(true);
                
                // Simular envio
                setTimeout(() => {
                    setLoading(false);
                    setSuccess(true);
                    setTimeout(() => {
                        navigate('/');
                    }, 2000);
                }, 2000);
            };
            
            if (success) {
                return (
                    <div className="max-w-2xl mx-auto">
                        <div className="card text-center">
                            <div className="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                <span className="text-2xl text-green-600">✅</span>
                            </div>
                            <h3 className="mt-4 text-lg font-medium text-gray-900">Empresa criada com sucesso!</h3>
                            <p className="mt-2 text-sm text-gray-500">
                                A página de avaliação foi gerada automaticamente e está pronta para uso.
                            </p>
                            <div className="mt-6">
                                <button
                                    onClick={() => navigate('/')}
                                    className="btn-primary"
                                >
                                    Voltar ao Dashboard
                                </button>
                            </div>
                        </div>
                    </div>
                );
            }
            
            return (
                <div className="max-w-2xl mx-auto">
                    <div className="mb-8">
                        <h2 className="text-2xl font-bold text-gray-900">Nova Empresa</h2>
                        <p className="mt-1 text-sm text-gray-500">
                            Crie uma nova empresa e gere automaticamente sua página de avaliação
                        </p>
                    </div>
                    
                    <form onSubmit={handleSubmit} className="space-y-6">
                        <div className="card">
                            <h3 className="text-lg font-medium text-gray-900 mb-4">Informações Básicas</h3>
                            
                            {/* Nome da Empresa */}
                            <div className="mb-4">
                                <label htmlFor="name" className="block text-sm font-medium text-gray-700 mb-2">
                                    Nome da Empresa *
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    required
                                    value={formData.name}
                                    onChange={handleInputChange}
                                    className="input-field"
                                    placeholder="Ex: Restaurante XYZ"
                                />
                            </div>
                            
                            {/* Email */}
                            <div className="mb-4">
                                <label htmlFor="email" className="block text-sm font-medium text-gray-700 mb-2">
                                    Email para Notificações *
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    required
                                    value={formData.email}
                                    onChange={handleInputChange}
                                    className="input-field"
                                    placeholder="contato@empresa.com"
                                />
                            </div>
                            
                            {/* URL do Google */}
                            <div className="mb-4">
                                <label htmlFor="googleUrl" className="block text-sm font-medium text-gray-700 mb-2">
                                    URL do Google Maps/Reviews *
                                </label>
                                <input
                                    type="url"
                                    name="googleUrl"
                                    id="googleUrl"
                                    required
                                    value={formData.googleUrl}
                                    onChange={handleInputChange}
                                    className="input-field"
                                    placeholder="https://maps.google.com/..."
                                />
                            </div>
                        </div>
                        
                        <div className="card">
                            <h3 className="text-lg font-medium text-gray-900 mb-4">Personalização</h3>
                            
                            {/* Upload Logo */}
                            <div className="mb-4">
                                <label htmlFor="logo" className="block text-sm font-medium text-gray-700 mb-2">
                                    Logo da Empresa
                                </label>
                                <div className="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div className="space-y-1 text-center">
                                        <span className="text-4xl">📷</span>
                                        <div className="flex text-sm text-gray-600">
                                            <label htmlFor="logo" className="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                                <span>Upload do logo</span>
                                                <input
                                                    id="logo"
                                                    name="logo"
                                                    type="file"
                                                    accept="image/*"
                                                    onChange={handleFileChange}
                                                    className="sr-only"
                                                />
                                            </label>
                                            <p className="pl-1">ou arraste e solte</p>
                                        </div>
                                        <p className="text-xs text-gray-500">PNG, JPG até 2MB</p>
                                    </div>
                                </div>
                            </div>
                            
                            {/* Upload Imagem de Fundo */}
                            <div className="mb-4">
                                <label htmlFor="backgroundImage" className="block text-sm font-medium text-gray-700 mb-2">
                                    Imagem de Fundo
                                </label>
                                <div className="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div className="space-y-1 text-center">
                                        <span className="text-4xl">🖼️</span>
                                        <div className="flex text-sm text-gray-600">
                                            <label htmlFor="backgroundImage" className="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                                <span>Upload da imagem</span>
                                                <input
                                                    id="backgroundImage"
                                                    name="backgroundImage"
                                                    type="file"
                                                    accept="image/*"
                                                    onChange={handleFileChange}
                                                    className="sr-only"
                                                />
                                            </label>
                                            <p className="pl-1">ou arraste e solte</p>
                                        </div>
                                        <p className="text-xs text-gray-500">PNG, JPG até 5MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div className="card">
                            <h3 className="text-lg font-medium text-gray-900 mb-4">Configurações de Avaliação</h3>
                            
                            {/* Threshold de Avaliação Positiva */}
                            <div className="mb-4">
                                <label htmlFor="positiveThreshold" className="block text-sm font-medium text-gray-700 mb-2">
                                    Limite para Avaliação Positiva
                                </label>
                                <div className="flex items-center space-x-4">
                                    <input
                                        type="range"
                                        name="positiveThreshold"
                                        id="positiveThreshold"
                                        min="1"
                                        max="5"
                                        step="1"
                                        value={formData.positiveThreshold}
                                        onChange={handleInputChange}
                                        className="flex-1"
                                    />
                                    <div className="flex items-center space-x-1">
                                        <span className="text-sm font-medium text-gray-700">
                                            {formData.positiveThreshold}+
                                        </span>
                                        <span className="text-lg">⭐</span>
                                    </div>
                                </div>
                                <p className="mt-1 text-sm text-gray-500">
                                    Avaliações com {formData.positiveThreshold} estrelas ou mais serão consideradas positivas
                                </p>
                            </div>
                        </div>
                        
                        <div className="flex justify-end space-x-3">
                            <button
                                type="button"
                                onClick={() => navigate('/')}
                                className="btn-secondary"
                            >
                                Cancelar
                            </button>
                            <button
                                type="submit"
                                disabled={loading}
                                className="btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                {loading ? 'Criando...' : 'Criar Empresa'}
                            </button>
                        </div>
                    </form>
                </div>
            );
        };
        
        // Componente ReviewsList
        const ReviewsList = () => {
            const [reviews, setReviews] = useState([
                {
                    id: 1,
                    company: 'Restaurante XYZ',
                    rating: 5,
                    whatsapp: '(11) 99999-9999',
                    comment: 'Excelente comida e atendimento!',
                    feedback: '',
                    date: '2025-10-17',
                    status: 'positive'
                },
                {
                    id: 2,
                    company: 'Loja ABC',
                    rating: 2,
                    whatsapp: '(11) 88888-8888',
                    comment: 'Produto não chegou como esperado',
                    feedback: 'O produto veio danificado e o atendimento foi ruim',
                    date: '2025-10-17',
                    status: 'negative'
                },
                {
                    id: 3,
                    company: 'Café 123',
                    rating: 4,
                    whatsapp: '(11) 77777-7777',
                    comment: 'Muito bom, recomendo!',
                    feedback: '',
                    date: '2025-10-16',
                    status: 'positive'
                }
            ]);
            const [filter, setFilter] = useState('all');
            
            const filteredReviews = reviews.filter(review => {
                if (filter === 'positive') return review.status === 'positive';
                if (filter === 'negative') return review.status === 'negative';
                return true;
            });
            
            return (
                <div className="space-y-6">
                    {/* Header */}
                    <div className="md:flex md:items-center md:justify-between">
                        <div className="min-w-0 flex-1">
                            <h2 className="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                                Avaliações
                            </h2>
                            <p className="mt-1 text-sm text-gray-500">
                                Gerencie todas as avaliações recebidas
                            </p>
                        </div>
                    </div>
                    
                    {/* Filters */}
                    <div className="card">
                        <div className="flex items-center space-x-4">
                            <span className="text-lg">🔍</span>
                            <div className="flex space-x-2">
                                <button
                                    onClick={() => setFilter('all')}
                                    className={`px-3 py-1 rounded-full text-sm font-medium ${
                                        filter === 'all'
                                            ? 'bg-blue-100 text-blue-700'
                                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                                    }`}
                                >
                                    Todas ({reviews.length})
                                </button>
                                <button
                                    onClick={() => setFilter('positive')}
                                    className={`px-3 py-1 rounded-full text-sm font-medium ${
                                        filter === 'positive'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                                    }`}
                                >
                                    Positivas ({reviews.filter(r => r.status === 'positive').length})
                                </button>
                                <button
                                    onClick={() => setFilter('negative')}
                                    className={`px-3 py-1 rounded-full text-sm font-medium ${
                                        filter === 'negative'
                                            ? 'bg-red-100 text-red-700'
                                            : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                                    }`}
                                >
                                    Negativas ({reviews.filter(r => r.status === 'negative').length})
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    {/* Reviews List */}
                    <div className="space-y-4">
                        {filteredReviews.map((review) => (
                            <div key={review.id} className="card">
                                <div className="flex items-start justify-between">
                                    <div className="flex-1">
                                        <div className="flex items-center space-x-3 mb-2">
                                            <h3 className="text-lg font-medium text-gray-900">
                                                {review.company}
                                            </h3>
                                            <div className="flex">
                                                {[...Array(5)].map((_, i) => (
                                                    <span
                                                        key={i}
                                                        className={`text-sm ${
                                                            i < review.rating ? 'text-yellow-400' : 'text-gray-300'
                                                        }`}
                                                    >
                                                        ⭐
                                                    </span>
                                                ))}
                                            </div>
                                            <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                                                review.status === 'positive'
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-red-100 text-red-800'
                                            }`}>
                                                {review.status === 'positive' ? '✅ Positiva' : '⚠️ Negativa'}
                                            </span>
                                        </div>
                                        
                                        <div className="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                                            <div className="flex items-center">
                                                <span className="mr-1">📱</span>
                                                {review.whatsapp}
                                            </div>
                                            <div>{review.date}</div>
                                        </div>
                                        
                                        {review.comment && (
                                            <div className="mb-3">
                                                <p className="text-sm text-gray-700">
                                                    <span className="font-medium">Comentário:</span> {review.comment}
                                                </p>
                                            </div>
                                        )}
                                        
                                        {review.feedback && (
                                            <div className="bg-orange-50 border border-orange-200 rounded-lg p-3">
                                                <p className="text-sm text-orange-800">
                                                    <span className="font-medium">Feedback:</span> {review.feedback}
                                                </p>
                                            </div>
                                        )}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            );
        };
        
        // Componente ReviewPage (Página Pública)
        const ReviewPage = () => {
            const { token } = useParams();
            const [company, setCompany] = useState({
                id: 1,
                name: 'Restaurante XYZ',
                logo: 'https://via.placeholder.com/150',
                backgroundImage: 'https://via.placeholder.com/800x400',
                email: 'contato@restaurantexyz.com',
                positiveThreshold: 4,
                googleUrl: 'https://maps.google.com/...'
            });
            const [rating, setRating] = useState(0);
            const [whatsapp, setWhatsapp] = useState('');
            const [comment, setComment] = useState('');
            const [feedback, setFeedback] = useState('');
            const [step, setStep] = useState('rating');
            
            const handleRatingSubmit = () => {
                if (rating > 0) {
                    setStep('whatsapp');
                }
            };
            
            const handleWhatsappSubmit = () => {
                if (whatsapp.trim()) {
                    if (rating >= company.positiveThreshold) {
                        setStep('success');
                        setTimeout(() => {
                            window.open(company.googleUrl, '_blank');
                        }, 3000);
                    } else {
                        setStep('feedback');
                    }
                }
            };
            
            const handleFeedbackSubmit = () => {
                if (feedback.trim()) {
                    setStep('success');
                }
            };
            
            const formatWhatsapp = (value) => {
                const numbers = value.replace(/\D/g, '');
                if (numbers.length <= 11) {
                    return numbers.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                }
                return value;
            };
            
            return (
                <div 
                    className="min-h-screen bg-cover bg-center bg-no-repeat"
                    style={{ backgroundImage: `url(${company.backgroundImage})` }}
                >
                    <div className="min-h-screen bg-black bg-opacity-50 flex items-center justify-center p-4">
                        <div className="max-w-md w-full">
                            <div className="bg-white rounded-2xl shadow-2xl p-8">
                                {/* Header */}
                                <div className="text-center mb-8">
                                    <img 
                                        src={company.logo} 
                                        alt={company.name}
                                        className="mx-auto h-16 w-16 rounded-full mb-4"
                                    />
                                    <h1 className="text-2xl font-bold text-gray-900 mb-2">
                                        {company.name}
                                    </h1>
                                    <p className="text-gray-600">
                                        Sua opinião é muito importante para nós!
                                    </p>
                                </div>
                                
                                {/* Rating Step */}
                                {step === 'rating' && (
                                    <div className="space-y-6">
                                        <div className="text-center">
                                            <h2 className="text-lg font-medium text-gray-900 mb-4">
                                                Como foi sua experiência?
                                            </h2>
                                            <div className="flex justify-center space-x-2">
                                                {[1, 2, 3, 4, 5].map((star) => (
                                                    <button
                                                        key={star}
                                                        onClick={() => setRating(star)}
                                                        className="focus:outline-none"
                                                    >
                                                        <span className={`text-4xl transition-colors ${
                                                            star <= rating ? 'text-yellow-400' : 'text-gray-300'
                                                        }`}>
                                                            ⭐
                                                        </span>
                                                    </button>
                                                ))}
                                            </div>
                                            <p className="mt-2 text-sm text-gray-500">
                                                {rating > 0 && `${rating} estrela${rating > 1 ? 's' : ''}`}
                                            </p>
                                        </div>
                                        
                                        <button
                                            onClick={handleRatingSubmit}
                                            disabled={rating === 0}
                                            className="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            Continuar
                                        </button>
                                    </div>
                                )}
                                
                                {/* WhatsApp Step */}
                                {step === 'whatsapp' && (
                                    <div className="space-y-6">
                                        <div className="text-center">
                                            <span className="text-4xl mb-4 block">📱</span>
                                            <h2 className="text-lg font-medium text-gray-900 mb-2">
                                                Seu WhatsApp
                                            </h2>
                                            <p className="text-sm text-gray-600">
                                                Precisamos do seu número para contato futuro
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <label htmlFor="whatsapp" className="block text-sm font-medium text-gray-700 mb-2">
                                                Número do WhatsApp
                                            </label>
                                            <input
                                                type="tel"
                                                id="whatsapp"
                                                value={whatsapp}
                                                onChange={(e) => setWhatsapp(formatWhatsapp(e.target.value))}
                                                placeholder="(11) 99999-9999"
                                                className="input-field"
                                                maxLength={15}
                                            />
                                        </div>
                                        
                                        <div>
                                            <label htmlFor="comment" className="block text-sm font-medium text-gray-700 mb-2">
                                                Comentário (opcional)
                                            </label>
                                            <textarea
                                                id="comment"
                                                value={comment}
                                                onChange={(e) => setComment(e.target.value)}
                                                placeholder="Conte-nos mais sobre sua experiência..."
                                                rows={3}
                                                className="input-field"
                                            />
                                        </div>
                                        
                                        <button
                                            onClick={handleWhatsappSubmit}
                                            disabled={!whatsapp.trim()}
                                            className="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            Enviar Avaliação
                                        </button>
                                    </div>
                                )}
                                
                                {/* Feedback Step */}
                                {step === 'feedback' && (
                                    <div className="space-y-6">
                                        <div className="text-center">
                                            <span className="text-4xl mb-4 block">💬</span>
                                            <h2 className="text-lg font-medium text-gray-900 mb-2">
                                                Ajude-nos a melhorar
                                            </h2>
                                            <p className="text-sm text-gray-600">
                                                Sua opinião nos ajuda a oferecer um serviço melhor
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <label htmlFor="feedback" className="block text-sm font-medium text-gray-700 mb-2">
                                                O que podemos melhorar?
                                            </label>
                                            <textarea
                                                id="feedback"
                                                value={feedback}
                                                onChange={(e) => setFeedback(e.target.value)}
                                                placeholder="Conte-nos o que não funcionou bem..."
                                                rows={4}
                                                className="input-field"
                                                required
                                            />
                                        </div>
                                        
                                        <button
                                            onClick={handleFeedbackSubmit}
                                            disabled={!feedback.trim()}
                                            className="w-full btn-primary disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            Enviar Feedback
                                        </button>
                                    </div>
                                )}
                                
                                {/* Success Step */}
                                {step === 'success' && (
                                    <div className="text-center space-y-6">
                                        <span className="text-6xl block">✅</span>
                                        <div>
                                            <h2 className="text-xl font-bold text-gray-900 mb-2">
                                                Obrigado pela sua avaliação!
                                            </h2>
                                            <p className="text-gray-600">
                                                {rating >= company.positiveThreshold 
                                                    ? 'Você será redirecionado para o Google em instantes...'
                                                    : 'Recebemos seu feedback e vamos trabalhar para melhorar!'
                                                }
                                            </p>
                                        </div>
                                        {rating >= company.positiveThreshold && (
                                            <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                                <p className="text-sm text-blue-800">
                                                    Redirecionando para o Google Maps em 3 segundos...
                                                </p>
                                            </div>
                                        )}
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            );
        };
        
        // Componente App Principal
        const App = () => {
            return (
                <BrowserRouter>
                    <div className="min-h-screen bg-gray-50">
                        <Routes>
                            {/* Rotas administrativas */}
                            <Route path="/" element={<Layout><Dashboard /></Layout>} />
                            <Route path="/companies" element={<Layout><CompanyForm /></Layout>} />
                            <Route path="/reviews" element={<Layout><ReviewsList /></Layout>} />
                            
                            {/* Rota pública para avaliações */}
                            <Route path="/r/:token" element={<ReviewPage />} />
                        </Routes>
                    </div>
                </BrowserRouter>
            );
        };
        
        // Renderizar a aplicação
        ReactDOM.render(<App />, document.getElementById('root'));
    </script>
</body>
</html>