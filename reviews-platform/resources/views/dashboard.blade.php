@extends('layouts.admin')

@section('title', 'Dashboard - Reviews Platform')

@section('page-title', 'Dashboard')
@section('page-description', 'Visão geral do sistema de avaliações')

@section('content')
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
@endsection

@section('scripts')
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
                        window.location.href = '/companies/create';
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
    </script>
@endsection 
