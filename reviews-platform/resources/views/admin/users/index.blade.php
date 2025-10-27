@extends('layouts.admin')

@section('title', 'Gerenciar Usuários')
@section('page-title', 'Gerenciar Usuários')
@section('page-description', 'Gerencie os usuários do sistema')

@section('header-actions')
    <a href="{{ route('users.create') }}" class="btn-primary px-6 py-2 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
        <i class="fas fa-plus"></i>
        Novo Usuário
    </a>
@endsection

@section('content')
<div class="fade-in">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-6 card-hover stagger-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total de Usuários</p>
                    <p class="text-3xl font-bold text-gray-800" id="statTotal">{{ $users->count() }}</p>
                    <p class="text-xs text-gray-500 mt-1" id="statTotalFiltered"></p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 card-hover stagger-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Administradores</p>
                    <p class="text-3xl font-bold text-gray-800" id="statAdmin">{{ $users->where('role', 'admin')->count() }}</p>
                    <p class="text-xs text-gray-500 mt-1" id="statAdminFiltered"></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-shield text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 card-hover stagger-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Usuários Padrão</p>
                    <p class="text-3xl font-bold text-gray-800" id="statUser">{{ $users->where('role', 'user')->count() }}</p>
                    <p class="text-xs text-gray-500 mt-1" id="statUserFiltered"></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input 
                        type="text" 
                        id="searchInput"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                        placeholder="Buscar por nome ou email..."
                        onkeyup="filterUsers()"
                    >
                </div>
            </div>
            
            <!-- Role Filter -->
            <div class="md:w-64">
                <select 
                    id="roleFilter" 
                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                    onchange="filterUsers()"
                >
                    <option value="all">Todas as funções</option>
                    <option value="admin">Administradores</option>
                    <option value="user">Usuários</option>
                </select>
            </div>
            
            <!-- Sort -->
            <div class="md:w-64">
                <select 
                    id="sortFilter" 
                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                    onchange="filterUsers()"
                >
                    <option value="newest">Mais recentes</option>
                    <option value="oldest">Mais antigos</option>
                    <option value="name-asc">Nome (A-Z)</option>
                    <option value="name-desc">Nome (Z-A)</option>
                </select>
            </div>
            
            <!-- Clear Filters -->
            <button 
                onclick="clearFilters()" 
                class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium whitespace-nowrap"
            >
                <i class="fas fa-times mr-2"></i>
                Limpar
            </button>
        </div>
        
        <!-- Results Count -->
        <div class="mt-4 pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                <i class="fas fa-info-circle mr-1"></i>
                Mostrando <span id="resultCount" class="font-semibold text-purple-600">{{ $users->count() }}</span> de <span class="font-semibold">{{ $users->count() }}</span> usuários
            </p>
        </div>
    </div>

    <!-- Users Grid -->
    <div class="space-y-4" id="usersContainer">
        @forelse($users as $user)
        <div class="user-card bg-white rounded-xl border border-gray-200 p-6 card-hover stagger-item"
             data-name="{{ strtolower($user->name) }}"
             data-email="{{ strtolower($user->email) }}"
             data-role="{{ $user->role }}"
             data-date="{{ $user->created_at->timestamp }}">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 flex-1">
                    <!-- Avatar -->
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" 
                             alt="{{ $user->name }}" 
                             class="flex-shrink-0 h-14 w-14 rounded-xl object-cover shadow-md border-2 border-purple-200">
                    @else
                        <div class="flex-shrink-0 h-14 w-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-lg">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </span>
                        </div>
                    @endif
                    
                    <!-- User Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="text-lg font-semibold text-gray-800 truncate">
                                {{ $user->name }}
                            </h3>
                            @if($user->id === Auth::id())
                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-user-check mr-1"></i>Você
                                </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-1.5 text-gray-400"></i>
                                <span class="truncate">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-calendar-alt mr-1.5 text-gray-400"></i>
                                <span>{{ $user->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Role & Actions -->
                <div class="flex items-center gap-3 ml-4">
                    <!-- Role Badge -->
                    @if($user->role === 'admin')
                        <span class="px-4 py-2 inline-flex items-center text-sm font-semibold rounded-lg bg-purple-100 text-purple-800">
                            <i class="fas fa-user-shield mr-2"></i>
                            Administrador
                        </span>
                    @else
                        <span class="px-4 py-2 inline-flex items-center text-sm font-semibold rounded-lg bg-gray-100 text-gray-800">
                            <i class="fas fa-user mr-2"></i>
                            Usuário
                        </span>
                    @endif
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2">
                        <a href="{{ route('users.edit', $user->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-all shadow-sm hover:shadow-md">
                            <i class="fas fa-edit mr-2"></i>
                            Editar
                        </a>
                        
                        @if($user->id !== Auth::id())
                        <form action="{{ route('users.destroy', $user->id) }}" 
                              method="POST" 
                              class="inline-block"
                              onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-all shadow-sm hover:shadow-md">
                                <i class="fas fa-trash mr-2"></i>
                                Excluir
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-users text-purple-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhum usuário encontrado</h3>
                <p class="text-gray-600 mb-6">Comece criando seu primeiro usuário no sistema.</p>
                <a href="{{ route('users.create') }}" class="btn-primary px-6 py-3 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Criar Primeiro Usuário
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
    const totalUsers = {{ $users->count() }};
    const totalAdmins = {{ $users->where('role', 'admin')->count() }};
    const totalRegularUsers = {{ $users->where('role', 'user')->count() }};
    
    function filterUsers() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const roleFilter = document.getElementById('roleFilter').value;
        const sortFilter = document.getElementById('sortFilter').value;
        
        let cards = Array.from(document.querySelectorAll('.user-card'));
        let visibleCount = 0;
        let visibleAdmins = 0;
        let visibleUsers = 0;
        
        // Filter cards
        cards.forEach(card => {
            const name = card.dataset.name;
            const email = card.dataset.email;
            const role = card.dataset.role;
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
            const matchesRole = roleFilter === 'all' || role === roleFilter;
            
            if (matchesSearch && matchesRole) {
                card.style.display = '';
                visibleCount++;
                if (role === 'admin') visibleAdmins++;
                else visibleUsers++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Sort visible cards
        const visibleCards = cards.filter(card => card.style.display !== 'none');
        
        visibleCards.sort((a, b) => {
            switch(sortFilter) {
                case 'newest':
                    return parseInt(b.dataset.date) - parseInt(a.dataset.date);
                case 'oldest':
                    return parseInt(a.dataset.date) - parseInt(b.dataset.date);
                case 'name-asc':
                    return a.dataset.name.localeCompare(b.dataset.name);
                case 'name-desc':
                    return b.dataset.name.localeCompare(a.dataset.name);
                default:
                    return 0;
            }
        });
        
        // Reorder cards in DOM
        const container = document.getElementById('usersContainer');
        visibleCards.forEach(card => {
            container.appendChild(card);
        });
        
        // Update count
        document.getElementById('resultCount').textContent = visibleCount;
        
        // Update stats
        updateStats(visibleCount, visibleAdmins, visibleUsers);
        
        // Show "no results" message
        showNoResultsMessage(visibleCount);
    }
    
    function updateStats(visible, admins, users) {
        const isFiltered = visible !== totalUsers;
        
        // Update total
        document.getElementById('statTotal').textContent = totalUsers;
        document.getElementById('statTotalFiltered').textContent = isFiltered ? `${visible} visíveis` : '';
        
        // Update admins
        document.getElementById('statAdmin').textContent = totalAdmins;
        document.getElementById('statAdminFiltered').textContent = isFiltered ? `${admins} visíveis` : '';
        
        // Update users
        document.getElementById('statUser').textContent = totalRegularUsers;
        document.getElementById('statUserFiltered').textContent = isFiltered ? `${users} visíveis` : '';
    }
    
    function clearFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('roleFilter').value = 'all';
        document.getElementById('sortFilter').value = 'newest';
        filterUsers();
    }
    
    function showNoResultsMessage(count) {
        const container = document.getElementById('usersContainer');
        let noResultsMsg = document.getElementById('noResultsMessage');
        
        if (count === 0) {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('div');
                noResultsMsg.id = 'noResultsMessage';
                noResultsMsg.className = 'bg-white rounded-xl border border-gray-200 p-12 text-center';
                noResultsMsg.innerHTML = `
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-search text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhum usuário encontrado</h3>
                        <p class="text-gray-600 mb-6">Tente ajustar os filtros ou a busca.</p>
                        <button onclick="clearFilters()" class="btn-primary px-6 py-3 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
                            <i class="fas fa-times"></i>
                            Limpar Filtros
                        </button>
                    </div>
                `;
                container.appendChild(noResultsMsg);
            }
        } else {
            if (noResultsMsg) {
                noResultsMsg.remove();
            }
        }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        filterUsers();
    });
</script>
@endsection

