<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Reviews Platform')</title>
    
    <!-- Prevent Dark Mode Flash -->
    <script>
        (function() {
            const savedMode = localStorage.getItem('darkMode');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (savedMode === 'true' || (savedMode === null && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: {
                            bg: '#111827',
                            card: '#1f2937',
                            border: '#374151'
                        }
                    }
                }
            }
        }
    </script>
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
            --primary-color: #8b5cf6;
            --primary-dark: #7c3aed;
            --primary-light: #a78bfa;
            --secondary-color: #3b82f6;
            --secondary-dark: #2563eb;
            --success-color: #10b981;
            --success-dark: #059669;
            --error-color: #ef4444;
            --error-dark: #dc2626;
            --warning-color: #f59e0b;
            --warning-dark: #d97706;
            --neutral-color: #6b7280;
            --neutral-dark: #4b5563;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            
            /* Light Mode Colors */
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --bg-tertiary: #f3f4f6;
            --text-primary: #111827;
            --text-secondary: #4b5563;
            --text-tertiary: #6b7280;
            --border-color: #e5e7eb;
            --border-color-light: #f3f4f6;
            --card-bg: #ffffff;
            --sidebar-bg: #fafafa;
            --header-bg: #ffffff;
        }
        
        /* Dark Mode Colors */
        .dark {
            --primary-color: #a78bfa;
            --primary-dark: #8b5cf6;
            
            /* Dark Mode Colors */
            --bg-primary: #111827;
            --bg-secondary: #1f2937;
            --bg-tertiary: #374151;
            --text-primary: #f9fafb;
            --text-secondary: #d1d5db;
            --text-tertiary: #9ca3af;
            --border-color: #374151;
            --border-color-light: #4b5563;
            --card-bg: #1f2937;
            --sidebar-bg: #1f2937;
            --header-bg: #1f2937;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }
        
        html {
            scroll-behavior: smooth;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        body {
            background-color: var(--bg-secondary);
            color: var(--text-primary);
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        /* Apply dark mode to Tailwind classes */
        .dark .bg-white {
            background-color: var(--card-bg) !important;
        }
        
        .dark .bg-gray-50 {
            background-color: var(--bg-secondary) !important;
        }
        
        .dark .bg-gray-100 {
            background-color: var(--bg-tertiary) !important;
        }
        
        .dark .text-gray-800 {
            color: var(--text-primary) !important;
        }
        
        .dark .text-gray-700 {
            color: var(--text-secondary) !important;
        }
        
        .dark .text-gray-600 {
            color: var(--text-tertiary) !important;
        }
        
        .dark .text-gray-500 {
            color: #9ca3af !important;
        }
        
        .dark .border-gray-200 {
            border-color: var(--border-color) !important;
        }
        
        .dark .border-gray-300 {
            border-color: var(--border-color-light) !important;
        }
        
        .dark input:not([type="checkbox"]):not([type="radio"]),
        .dark select,
        .dark textarea {
            background-color: var(--bg-tertiary);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        
        .dark input:focus:not([type="checkbox"]):not([type="radio"]),
        .dark select:focus,
        .dark textarea:focus {
            background-color: var(--bg-tertiary);
            border-color: var(--primary-color);
        }
        
        /* Sidebar */
        .sidebar-gradient {
            background: var(--sidebar-bg);
        }
        
        /* Navigation Items */
        .nav-item {
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }
        
        .nav-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--primary-color);
            transform: scaleY(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-item:hover {
            background-color: rgba(139, 92, 246, 0.08);
            color: var(--primary-color);
            transform: translateX(2px);
        }
        
        .nav-item.active {
            background-color: rgba(139, 92, 246, 0.12);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .nav-item.active::before,
        .nav-item:hover::before {
            transform: scaleY(1);
        }
        
        .nav-item i {
            transition: transform 0.3s ease;
        }
        
        .nav-item:hover i {
            transform: scale(1.1);
        }
        
        /* Logo */
        .logo-gradient {
            background: var(--primary-color);
        }
        
        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            transition: var(--transition-smooth);
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.25);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-secondary {
            background: var(--neutral-color);
            transition: var(--transition-smooth);
        }
        
        .btn-secondary:hover {
            background: var(--neutral-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(107, 114, 128, 0.2);
        }
        
        /* Cards */
        .card-hover {
            transition: var(--transition-smooth);
            position: relative;
            background-color: var(--card-bg);
        }
        
        .card-hover::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: rgba(139, 92, 246, 0.03);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }
        
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
        }
        
        .dark .card-hover:hover {
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.5);
        }
        
        .card-hover:hover::after {
            opacity: 1;
        }
        
        /* Icon Backgrounds */
        .icon-gradient {
            background: var(--primary-color);
        }
        
        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .slide-in-left {
            animation: slideInLeft 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .slide-in-right {
            animation: slideInRight 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .scale-in {
            animation: scaleIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Staggered Animation */
        .stagger-item {
            opacity: 0;
            animation: fadeInUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stagger-item:nth-child(1) { animation-delay: 0.05s; }
        .stagger-item:nth-child(2) { animation-delay: 0.1s; }
        .stagger-item:nth-child(3) { animation-delay: 0.15s; }
        .stagger-item:nth-child(4) { animation-delay: 0.2s; }
        .stagger-item:nth-child(5) { animation-delay: 0.25s; }
        .stagger-item:nth-child(6) { animation-delay: 0.3s; }
        .stagger-item:nth-child(7) { animation-delay: 0.35s; }
        .stagger-item:nth-child(8) { animation-delay: 0.4s; }
        .stagger-item:nth-child(9) { animation-delay: 0.45s; }
        
        /* Skeleton Loader */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s ease-in-out infinite;
        }
        
        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Pulse Animation */
        .pulse-soft {
            animation: pulseSoft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulseSoft {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }
        
        /* Shimmer Effect */
        .shimmer {
            position: relative;
            overflow: hidden;
        }
        
        .shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            transform: translateX(-100%);
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            100% {
                transform: translateX(100%);
            }
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.2);
            border-radius: 10px;
            transition: background 0.3s ease;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 92, 246, 0.4);
        }
        
        .dark ::-webkit-scrollbar-thumb {
            background: rgba(139, 92, 246, 0.4);
        }
        
        .dark ::-webkit-scrollbar-thumb:hover {
            background: rgba(139, 92, 246, 0.6);
        }
        
        /* Notifications - Dark Mode Support */
        .dark .bg-green-50 {
            background-color: rgba(16, 185, 129, 0.1) !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
        }
        
        .dark .bg-red-50 {
            background-color: rgba(239, 68, 68, 0.1) !important;
            border-color: rgba(239, 68, 68, 0.3) !important;
        }
        
        .dark .bg-blue-50 {
            background-color: rgba(59, 130, 246, 0.1) !important;
            border-color: rgba(59, 130, 246, 0.3) !important;
        }
        
        .dark .bg-yellow-50 {
            background-color: rgba(251, 191, 36, 0.1) !important;
            border-color: rgba(251, 191, 36, 0.3) !important;
        }
        
        .dark .text-green-800 {
            color: rgb(134, 239, 172) !important;
        }
        
        .dark .text-red-800 {
            color: rgb(252, 165, 165) !important;
        }
        
        .dark .text-blue-800 {
            color: rgb(147, 197, 253) !important;
        }
        
        .dark .text-yellow-800 {
            color: rgb(253, 224, 71) !important;
        }
        
        /* Skeleton Loading Styles */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s ease-in-out infinite;
            border-radius: 4px;
        }
        
        .dark .skeleton {
            background: linear-gradient(90deg, #374151 25%, #4b5563 50%, #374151 75%);
            background-size: 200% 100%;
        }
        
        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .skeleton-card {
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }
        
        .dark .skeleton-card {
            background: #1f2937;
            border-color: #374151;
        }
        
        .skeleton-avatar {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s ease-in-out infinite;
            margin-bottom: 1rem;
        }
        
        .dark .skeleton-avatar {
            background: linear-gradient(90deg, #374151 25%, #4b5563 50%, #374151 75%);
            background-size: 200% 100%;
        }
        
        .skeleton-line {
            height: 12px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s ease-in-out infinite;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }
        
        .dark .skeleton-line {
            background: linear-gradient(90deg, #374151 25%, #4b5563 50%, #374151 75%);
            background-size: 200% 100%;
        }
        
        .skeleton-line.w-full { width: 100%; }
        .skeleton-line.w-3-4 { width: 75%; }
        .skeleton-line.w-1-2 { width: 50%; }
        .skeleton-line.w-1-4 { width: 25%; }
        
        .skeleton-circle {
            border-radius: 50%;
        }
        
        .skeleton-text {
            height: 16px;
            margin-bottom: 8px;
        }
        
        .skeleton-title {
            height: 24px;
            margin-bottom: 12px;
        }
        
        /* Image Lazy Loading */
        .image-placeholder {
            position: relative;
            background: #f0f0f0;
            overflow: hidden;
            border-radius: 8px;
        }
        
        .dark .image-placeholder {
            background: #374151;
        }
        
        .image-placeholder img {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .image-placeholder.loaded img {
            opacity: 1;
        }
        
        .image-placeholder.loaded .placeholder-shimmer {
            display: none;
        }
        
        .placeholder-shimmer {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
            animation: shimmer-move 1.5s infinite;
        }
        
        .dark .placeholder-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
        }
        
        @keyframes shimmer-move {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Input Styles */
        input:not([type="checkbox"]):not([type="radio"]),
        select,
        textarea {
            transition: var(--transition-smooth);
        }
        
        input:focus:not([type="checkbox"]):not([type="radio"]),
        select:focus,
        textarea:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.15);
        }
        
        /* Focus Ring */
        *:focus {
            outline: none;
        }
        
        *:focus-visible {
            outline: 2px solid rgba(139, 92, 246, 0.5);
            outline-offset: 2px;
        }
        
        /* Page Container */
        .page-container {
            min-height: 100vh;
        }
        
        /* Content Area */
        .content-area {
            min-height: calc(100vh - 80px);
        }
        
        /* Button Protection - Prevent buttons from disappearing */
        button,
        .btn-primary,
        .btn-secondary,
        .btn-danger,
        a[role="button"] {
            display: inline-flex !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
        }
        
        button:disabled,
        .btn-primary:disabled,
        .btn-secondary:disabled {
            opacity: 0.5 !important;
            cursor: not-allowed;
            pointer-events: auto !important;
        }
        
        /* Ensure buttons remain visible during animations */
        button,
        .btn-primary,
        .btn-secondary {
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease !important;
        }
        
        /* Prevent JS errors from hiding buttons */
        .hidden:is(button, .btn-primary, .btn-secondary, .btn-danger) {
            display: none !important;
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
                        <h1 class="text-lg font-bold text-gray-800">{{ __('app.name') }}</h1>
                        <p class="text-xs text-gray-500">{{ __('app.subtitle') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    {{ __('app.dashboard') }}
                </a>
                <a href="/companies" class="nav-item {{ request()->is('companies*') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-building w-5 h-5 mr-3"></i>
                    {{ in_array(Auth::user()->role, ['admin', 'proprietario']) ? __('app.companies') : 'Minha Empresa' }}
                </a>
                
                <a href="/reviews" class="nav-item {{ request()->is('reviews*') && !request()->is('reviews/negative') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-star w-5 h-5 mr-3"></i>
                    {{ __('app.reviews') }}
                </a>
                <a href="/reviews/negative" class="nav-item {{ request()->is('reviews/negative') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                    <i class="fas fa-exclamation-triangle w-5 h-5 mr-3"></i>
                    {{ __('app.negative_reviews') }}
                </a>
                
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">{{ __('app.settings') }}</p>
                    
                    @if(in_array(Auth::user()->role, ['admin', 'proprietario']))
                    <a href="{{ route('users.index') }}" class="nav-item {{ request()->is('users*') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-users w-5 h-5 mr-3"></i>
                        {{ __('users.title') }}
                    </a>
                    @endif
                    
                    {{-- Subscription and Billing - Hidden for future use --}}
                    {{-- 
                    <a href="/subscription" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-crown w-5 h-5 mr-3"></i>
                        {{ __('app.subscription') }}
                    </a>
                    <a href="/billing" class="nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-credit-card w-5 h-5 mr-3"></i>
                        {{ __('app.billing') }}
                    </a>
                    --}}
                    <a href="/profile" class="nav-item {{ request()->is('profile') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-user w-5 h-5 mr-3"></i>
                        {{ __('app.profile') }}
                    </a>
                </div>
                
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">{{ __('app.support') }}</p>
                    <a href="{{ route('support.help-center') }}" class="nav-item {{ request()->is('support') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-life-ring w-5 h-5 mr-3"></i>
                        {{ __('app.help_center') }}
                    </a>
                    <a href="{{ route('support.faqs') }}" class="nav-item {{ request()->is('faqs') ? 'active' : '' }} flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-question-circle w-5 h-5 mr-3"></i>
                        {{ __('app.faqs') }}
                    </a>
                </div>
            </nav>
            
            <!-- User Section -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3 mb-3">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="w-10 h-10 rounded-full object-cover border-2 border-purple-200">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-xs">
                                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                            </span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name ?? __('app.user') }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                    </div>
                </div>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full nav-item flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        {{ __('app.logout') }}
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
                        <!-- Language Selector -->
                        <x-language-selector />
                        
                        <!-- Dark Mode Toggle -->
                        <button 
                            id="darkModeToggle"
                            onclick="toggleDarkMode()"
                            class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                            aria-label="Toggle dark mode"
                        >
                            <i id="darkModeIcon" class="fas fa-moon text-gray-600 dark:text-gray-300 text-lg"></i>
                        </button>
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
        // Dark Mode Toggle
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            const icon = document.getElementById('darkModeIcon');
            
            // Update icon
            if (isDark) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
            
            // Save preference
            localStorage.setItem('darkMode', isDark ? 'true' : 'false');
            
            // Show feedback
            showNotification(
                isDark ? 'Modo escuro ativado' : 'Modo claro ativado',
                'info',
                2000
            );
        }
        
        // Initialize dark mode from saved preference
        function initDarkMode() {
            const savedMode = localStorage.getItem('darkMode');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const icon = document.getElementById('darkModeIcon');
            
            // Use saved preference, or system preference if no saved preference
            if (savedMode === 'true' || (savedMode === null && prefersDark)) {
                document.documentElement.classList.add('dark');
                if (icon) {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                }
            }
        }
        
        // Initialize immediately to prevent flash
        initDarkMode();
        
        // Reinitialize after DOM is ready (in case icon wasn't loaded yet)
        document.addEventListener('DOMContentLoaded', initDarkMode);
        
        // Enhanced Notification System
        function showNotification(message, type = 'info', duration = 3000) {
            const notification = document.createElement('div');
            
            const colors = {
                success: 'bg-green-500',
                error: 'bg-red-500',
                warning: 'bg-yellow-500',
                info: 'bg-blue-500'
            };
            
            const icons = {
                success: 'check-circle',
                error: 'exclamation-circle',
                warning: 'exclamation-triangle',
                info: 'info-circle'
            };
            
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-2xl ${colors[type]} text-white transform translate-x-full transition-all duration-500 ease-out backdrop-blur-sm`;
            notification.style.cssText = 'backdrop-filter: blur(10px); max-width: 400px;';
            
            notification.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <i class="fas fa-${icons[type]} text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 opacity-70 hover:opacity-100 transition-opacity">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-white bg-opacity-30 rounded-b-xl overflow-hidden">
                    <div class="progress-bar h-full bg-white bg-opacity-50" style="width: 100%; animation: progress ${duration}ms linear;"></div>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Slide in
            requestAnimationFrame(() => {
                notification.style.transform = 'translateX(0)';
            });
            
            // Auto remove
            setTimeout(() => {
                notification.style.transform = 'translateX(calc(100% + 1rem))';
                notification.style.opacity = '0';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 500);
            }, duration);
        }
        
        // Progress bar animation
        const progressStyle = document.createElement('style');
        progressStyle.textContent = `
            @keyframes progress {
                from { width: 100%; }
                to { width: 0%; }
            }
        `;
        document.head.appendChild(progressStyle);
        
        // Auto-hide success/error messages with fade - only target notification messages
        setTimeout(() => {
            // Only target notification divs in main content area with proper structure
            document.querySelectorAll('main > .bg-green-50, main > .bg-red-50, main > .bg-blue-50').forEach(el => {
                // Check if this is actually a notification (has border and specific classes)
                if (el.classList.contains('border') && (
                    el.classList.contains('border-green-200') || 
                    el.classList.contains('border-red-200') || 
                    el.classList.contains('border-blue-200')
                )) {
                    el.style.transition = 'all 0.5s ease-out';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        if (el.parentElement && document.body.contains(el)) {
                            el.remove();
                        }
                    }, 500);
                }
            });
        }, 5000);
        
        // Add loading overlay function
        function showLoading(message = 'Carregando...') {
            const overlay = document.createElement('div');
            overlay.id = 'loading-overlay';
            overlay.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center backdrop-blur-sm';
            overlay.style.cssText = 'backdrop-filter: blur(8px);';
            
            overlay.innerHTML = `
                <div class="bg-white rounded-2xl p-8 shadow-2xl scale-in">
                    <div class="flex flex-col items-center gap-4">
                        <div class="relative">
                            <div class="w-16 h-16 border-4 border-purple-200 rounded-full"></div>
                            <div class="w-16 h-16 border-4 border-purple-600 rounded-full border-t-transparent absolute top-0 left-0" style="animation: spin 1s linear infinite;"></div>
                        </div>
                        <p class="text-gray-700 font-medium">${message}</p>
                    </div>
                </div>
            `;
            
            document.body.appendChild(overlay);
            return overlay;
        }
        
        function hideLoading() {
            const overlay = document.getElementById('loading-overlay');
            if (overlay) {
                overlay.style.opacity = '0';
                setTimeout(() => overlay.remove(), 300);
            }
        }
        
        // Spin animation
        const spinStyle = document.createElement('style');
        spinStyle.textContent = `
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(spinStyle);
        
        // Add smooth page transitions
        document.addEventListener('DOMContentLoaded', function() {
            // Fade in body
            document.body.style.opacity = '0';
            requestAnimationFrame(() => {
                document.body.style.transition = 'opacity 0.3s ease-out';
                document.body.style.opacity = '1';
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>

