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
        
        .btn-primary {
            @apply bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200;
        }
        
        .btn-secondary {
            @apply bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200;
        }
        
        .card {
            @apply bg-white rounded-xl shadow-sm border border-gray-200 p-6;
        }
        
        .input-field {
            @apply block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500;
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
                { name: 'Dashboard', href: '/', icon: '🏠' },
                { name: 'Empresas', href: '/companies', icon: '🏢' },
                { name: 'Avaliações', href: '/reviews', icon: '💬' },
            ];
            
            return (
                <div className="min-h-screen bg-gray-50">
                    {/* Sidebar Mobile */}
                    <div className={`fixed inset-0 z-50 lg:hidden ${sidebarOpen ? 'block' : 'hidden'}`}>
                        <div className="fixed inset-0 bg-gray-600 bg-opacity-75" onClick={() => setSidebarOpen(false)} />
                        <div className="fixed inset-y-0 left-0 flex w-64 flex-col bg-white">
                            <div className="flex h-16 items-center justify-between px-4">
                                <h1 className="text-xl font-bold text-gray-900">Reviews Platform</h1>
                                <button onClick={() => setSidebarOpen(false)}>✕</button>
                            </div>
                            <nav className="flex-1 px-4 py-4">
                                {navigation.map((item) => (
                                    <Link
                                        key={item.name}
                                        to={item.href}
                                        className={`group flex items-center px-2 py-2 text-sm font-medium rounded-md mb-1 ${
                                            location === item.href
                                                ? 'bg-blue-100 text-blue-700'
                                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                                        }`}
                                    >
                                        <span className="mr-3">{item.icon}</span>
                                        {item.name}
                                    </Link>
                                ))}
                            </nav>
                        </div>
                    </div>
                    
                    {/* Sidebar Desktop */}
                    <div className="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
                        <div className="flex flex-col flex-grow bg-white border-r border-gray-200">
                            <div className="flex h-16 items-center px-4">
                                <h1 className="text-xl font-bold text-gray-900">Reviews Platform</h1>
                            </div>
                            <nav className="flex-1 px-4 py-4">
                                {navigation.map((item) => (
                                    <Link
                                        key={item.name}
                                        to={item.href}
                                        className={`group flex items-center px-2 py-2 text-sm font-medium rounded-md mb-1 ${
                                            location === item.href
                                                ? 'bg-blue-100 text-blue-700'
                                                : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                                        }`}
                                    >
                                        <span className="mr-3">{item.icon}</span>
                                        {item.name}
                                    </Link>
                                ))}
                            </nav>
                        </div>
                    </div>
                    
                    {/* Main Content */}
                    <div className="lg:pl-64">
                        {/* Top Bar */}
                        <div className="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                            <button
                                type="button"
                                className="-m-2.5 p-2.5 text-gray-700 lg:hidden"
                                onClick={() => setSidebarOpen(true)}
                            >
                                ☰
                            </button>
                            <div className="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                                <div className="flex flex-1"></div>
                                <div className="flex items-center gap-x-4 lg:gap-x-6">
                                    <div className="text-sm font-medium text-gray-700">Admin</div>
                                </div>
                            </div>
                        </div>
                        
                        {/* Page Content */}
                        <main className="py-6">
                            <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                                {children}
                            </div>
                        </main>
                    </div>
                </div>
            );
        };
        
        // Componente Dashboard
        const Dashboard = () => {
            const [stats, setStats] = useState({
                totalCompanies: 12,
                totalReviews: 156,
                averageRating: 4.2,
                negativeReviews: 8,
                positiveReviews: 148,
                recentReviews: [
                    { id: 1, company: 'Restaurante XYZ', rating: 5, whatsapp: '(11) 99999-9999', date: '2025-10-17' },
                    { id: 2, company: 'Loja ABC', rating: 2, whatsapp: '(11) 88888-8888', date: '2025-10-17' },
                    { id: 3, company: 'Café 123', rating: 4, whatsapp: '(11) 77777-7777', date: '2025-10-16' },
                ]
            });
            
            const statCards = [
                {
                    name: 'Total de Empresas',
                    value: stats.totalCompanies,
                    icon: '🏢',
                    color: 'bg-blue-500',
                    change: '+2',
                    changeType: 'positive'
                },
                {
                    name: 'Total de Avaliações',
                    value: stats.totalReviews,
                    icon: '💬',
                    color: 'bg-green-500',
                    change: '+12',
                    changeType: 'positive'
                },
                {
                    name: 'Avaliação Média',
                    value: stats.averageRating.toFixed(1),
                    icon: '⭐',
                    color: 'bg-yellow-500',
                    change: '+0.2',
                    changeType: 'positive'
                },
                {
                    name: 'Avaliações Negativas',
                    value: stats.negativeReviews,
                    icon: '⚠️',
                    color: 'bg-red-500',
                    change: '-1',
                    changeType: 'negative'
                }
            ];
            
            return (
                <div className="space-y-6">
                    {/* Header */}
                    <div className="md:flex md:items-center md:justify-between">
                        <div className="min-w-0 flex-1">
                            <h2 className="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                                Dashboard
                            </h2>
                            <p className="mt-1 text-sm text-gray-500">
                                Visão geral da plataforma de avaliações
                            </p>
                        </div>
                        <div className="mt-4 flex md:ml-4 md:mt-0">
                            <Link to="/companies" className="btn-primary">
                                Nova Empresa
                            </Link>
                        </div>
                    </div>
                    
                    {/* Stats Grid */}
                    <div className="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        {statCards.map((card) => (
                            <div key={card.name} className="card">
                                <div className="flex items-center">
                                    <div className="flex-shrink-0">
                                        <div className={`${card.color} p-3 rounded-lg`}>
                                            <span className="text-2xl">{card.icon}</span>
                                        </div>
                                    </div>
                                    <div className="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt className="text-sm font-medium text-gray-500 truncate">
                                                {card.name}
                                            </dt>
                                            <dd className="flex items-baseline">
                                                <div className="text-2xl font-semibold text-gray-900">
                                                    {card.value}
                                                </div>
                                                <div className={`ml-2 flex items-baseline text-sm font-semibold ${
                                                    card.changeType === 'positive' ? 'text-green-600' : 'text-red-600'
                                                }`}>
                                                    <span className="sr-only">
                                                        {card.changeType === 'positive' ? 'Increased' : 'Decreased'} by
                                                    </span>
                                                    {card.change}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                    
                    {/* Recent Reviews */}
                    <div className="card">
                        <h3 className="text-lg font-medium text-gray-900 mb-4">Avaliações Recentes</h3>
                        <div className="flow-root">
                            <ul className="-my-5 divide-y divide-gray-200">
                                {stats.recentReviews.map((review) => (
                                    <li key={review.id} className="py-5">
                                        <div className="flex items-center space-x-4">
                                            <div className="flex-shrink-0">
                                                <div className={`p-2 rounded-lg ${
                                                    review.rating >= 4 ? 'bg-green-100' : 'bg-red-100'
                                                }`}>
                                                    <span className={`text-lg ${
                                                        review.rating >= 4 ? 'text-green-600' : 'text-red-600'
                                                    }`}>⭐</span>
                                                </div>
                                            </div>
                                            <div className="flex-1 min-w-0">
                                                <p className="text-sm font-medium text-gray-900 truncate">
                                                    {review.company}
                                                </p>
                                                <p className="text-sm text-gray-500 truncate">
                                                    WhatsApp: {review.whatsapp}
                                                </p>
                                            </div>
                                            <div className="flex items-center space-x-2">
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
                                                <span className="text-sm text-gray-500">{review.date}</span>
                                            </div>
                                        </div>
                                    </li>
                                ))}
                            </ul>
                        </div>
                        <div className="mt-6">
                            <Link
                                to="/reviews"
                                className="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                            >
                                Ver todas as avaliações
                            </Link>
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