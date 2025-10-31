@extends('layouts.admin')

@section('title', __('users.title') . ' - ' . __('app.name'))
@section('page-title', __('users.title'))
@section('page-description', __('users.description'))

@section('header-actions')
    <a href="{{ route('users.create') }}" class="btn-primary px-6 py-2 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
        <i class="fas fa-plus"></i>
        {{ __('users.new_user') }}
    </a>
@endsection

@section('content')
<div class="fade-in">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-6 card-hover stagger-item">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">{{ __('users.total_users') }}</p>
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
                    <p class="text-sm font-medium text-gray-600 mb-1">{{ __('users.administrators') }}</p>
                    <p class="text-3xl font-bold text-gray-800" id="statAdmin">{{ $users->where('role', 'admin')->count() }}</p>
                    @if(Auth::user()->role === 'proprietario')
                        <p class="text-xs text-gray-500 mt-1">
                            {{ __('users.owners') }}: {{ $users->where('role', 'proprietario')->count() }}
                        </p>
                    @endif
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
                    <p class="text-sm font-medium text-gray-600 mb-1">{{ __('users.standard_users') }}</p>
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
    <div class="bg-white rounded-xl border border-gray-200 p-4 lg:p-6 mb-6">
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
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
                        placeholder="{{ __('users.search_placeholder') }}"
                        onkeyup="filterUsers()"
                    >
                </div>
            </div>
            
            <!-- Role Filter -->
            <div class="w-full sm:w-auto sm:min-w-[200px]">
                <select 
                    id="roleFilter" 
                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-sm sm:text-base"
                    onchange="filterUsers()"
                >
                    <option value="all">{{ __('users.all_roles') }}</option>
                    @if(Auth::user()->role === 'proprietario')
                        <option value="proprietario">{{ __('users.role_owner') }}</option>
                    @endif
                    @if(Auth::user()->role === 'proprietario')
                        <option value="admin">{{ __('users.role_admin') }}</option>
                    @endif
                    <option value="user">{{ __('users.role_user') }}</option>
                </select>
            </div>
            
            <!-- Sort -->
            <div class="w-full sm:w-auto sm:min-w-[200px]">
                <select 
                    id="sortFilter" 
                    class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-sm sm:text-base"
                    onchange="filterUsers()"
                >
                    <option value="newest">{{ __('users.sort_newest') }}</option>
                    <option value="oldest">{{ __('users.sort_oldest') }}</option>
                    <option value="name-asc">{{ __('users.sort_name_asc') }}</option>
                    <option value="name-desc">{{ __('users.sort_name_desc') }}</option>
                </select>
            </div>
            
            <!-- Clear Filters -->
            <button 
                onclick="clearFilters()" 
                class="w-full sm:w-auto px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium whitespace-nowrap text-sm sm:text-base"
            >
                <i class="fas fa-times mr-2"></i>
                {{ __('users.clear') }}
            </button>
        </div>
        
        <!-- Results Count -->
        <div class="mt-4 pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                <i class="fas fa-info-circle mr-1"></i>
                <span id="resultText">{{ __('users.showing') }} <span id="resultCount" class="font-semibold text-purple-600">{{ $users->count() }}</span> {{ __('users.of') }} <span id="resultTotal" class="font-semibold">{{ $users->count() }}</span> {{ __('users.users') }}</span>
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
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center space-x-4 flex-1 min-w-0">
                    <!-- Avatar -->
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" 
                             alt="{{ $user->name }}" 
                             class="flex-shrink-0 h-12 w-12 lg:h-14 lg:w-14 rounded-xl object-cover shadow-md border-2 border-purple-200">
                    @else
                        <div class="flex-shrink-0 h-12 w-12 lg:h-14 lg:w-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md">
                            <span class="text-white font-bold text-base lg:text-lg">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </span>
                        </div>
                    @endif
                    
                    <!-- User Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-1">
                            <h3 class="text-base lg:text-lg font-semibold text-gray-800 truncate">
                                {{ $user->name }}
                            </h3>
                            @if($user->id === Auth::id())
                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 self-start">
                                    <i class="fas fa-user-check mr-1"></i>{{ __('users.you') }}
                                </span>
                            @endif
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 text-sm text-gray-600">
                            <div class="flex items-center min-w-0">
                                <i class="fas fa-envelope mr-1.5 text-gray-400 flex-shrink-0"></i>
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
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 lg:ml-4">
                    <!-- Role Badge -->
                    <div class="self-start sm:self-auto">
                        @if($user->role === 'proprietario')
                            <span class="px-3 lg:px-4 py-1.5 lg:py-2 inline-flex items-center text-xs lg:text-sm font-semibold rounded-lg bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 border border-yellow-200 dark:border-yellow-700">
                                <i class="fas fa-crown mr-2"></i>
                                {{ __('users.owner') }}
                            </span>
                        @elseif($user->role === 'admin')
                            <span class="px-3 lg:px-4 py-1.5 lg:py-2 inline-flex items-center text-xs lg:text-sm font-semibold rounded-lg bg-purple-100 text-purple-800">
                                <i class="fas fa-user-shield mr-2"></i>
                                {{ __('users.administrator') }}
                            </span>
                        @else
                            <span class="px-3 lg:px-4 py-1.5 lg:py-2 inline-flex items-center text-xs lg:text-sm font-semibold rounded-lg bg-gray-100 text-gray-800">
                                <i class="fas fa-user mr-2"></i>
                                {{ __('users.user') }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-stretch sm:items-center gap-2">
                        <a href="{{ route('users.edit', $user->id) }}" 
                           class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 lg:px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-all shadow-sm hover:shadow-md">
                            <i class="fas fa-edit mr-2"></i>
                            <span>{{ __('users.edit') }}</span>
                        </a>
                        
                        @if($user->id !== Auth::id())
                        <form action="{{ route('users.destroy', $user->id) }}" 
                              method="POST" 
                              class="flex-1 sm:flex-none"
                              onsubmit="return confirm('{{ __('users.confirm_delete') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-3 lg:px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-all shadow-sm hover:shadow-md">
                                <i class="fas fa-trash mr-2"></i>
                                <span class="sm:hidden lg:inline">{{ __('users.delete') }}</span>
                                <span class="hidden sm:inline lg:hidden">{{ __('users.delete_short', ['default' => 'Excluir']) }}</span>
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
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('users.no_users_found') }}</h3>
                <p class="text-gray-600 mb-6">{{ __('users.start_creating') }}</p>
                <a href="{{ route('users.create') }}" class="btn-primary px-6 py-3 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    {{ __('users.create_first_user') }}
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Translations for JavaScript
    const translations = {
        pt_BR: {
            visible: '{{ __('users.visible') }}',
            no_users_found: '{{ __('users.no_users_found') }}',
            try_adjusting_filters: '{{ __('users.try_adjusting_filters') }}',
            clear_filters: '{{ __('users.clear_filters') }}',
            showing: '{{ __('users.showing') }}',
            of: '{{ __('users.of') }}',
            users: '{{ __('users.users') }}'
        },
        en_US: {
            visible: '{{ __('users.visible') }}',
            no_users_found: '{{ __('users.no_users_found') }}',
            try_adjusting_filters: '{{ __('users.try_adjusting_filters') }}',
            clear_filters: '{{ __('users.clear_filters') }}',
            showing: '{{ __('users.showing') }}',
            of: '{{ __('users.of') }}',
            users: '{{ __('users.users') }}'
        }
    };
    
    const currentLang = '{{ app()->getLocale() }}';
    const t = translations[currentLang] || translations.pt_BR;
    
    const totalUsers = {{ $users->count() }};
    const totalOwners = {{ $users->where('role', 'proprietario')->count() }};
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
                else if (role === 'user') visibleUsers++;
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
        
        // Update count and text
        document.getElementById('resultCount').textContent = visibleCount;
        document.getElementById('resultTotal').textContent = totalUsers;
        document.getElementById('resultText').innerHTML = `${t.showing} <span id="resultCount" class="font-semibold text-purple-600">${visibleCount}</span> ${t.of} <span id="resultTotal" class="font-semibold">${totalUsers}</span> ${t.users}`;
        
        // Update stats
        updateStats(visibleCount, visibleAdmins, visibleUsers);
        
        // Show "no results" message
        showNoResultsMessage(visibleCount);
    }
    
    function updateStats(visible, admins, users) {
        const isFiltered = visible !== totalUsers;
        
        // Update total
        document.getElementById('statTotal').textContent = totalUsers;
        document.getElementById('statTotalFiltered').textContent = isFiltered ? `${visible} ${t.visible}` : '';
        
        // Update admins
        document.getElementById('statAdmin').textContent = totalAdmins;
        document.getElementById('statAdminFiltered').textContent = isFiltered ? `${admins} ${t.visible}` : '';
        
        // Update users
        document.getElementById('statUser').textContent = totalRegularUsers;
        document.getElementById('statUserFiltered').textContent = isFiltered ? `${users} ${t.visible}` : '';
        
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
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">${t.no_users_found}</h3>
                        <p class="text-gray-600 mb-6">${t.try_adjusting_filters}</p>
                        <button onclick="clearFilters()" class="btn-primary px-6 py-3 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
                            <i class="fas fa-times"></i>
                            ${t.clear_filters}
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

