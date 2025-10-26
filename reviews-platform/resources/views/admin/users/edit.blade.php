@extends('layouts.admin')

@section('title', 'Editar Usuário')
@section('page-title', 'Editar Usuário')
@section('page-description', 'Atualize as informações do usuário')

@section('content')
<div class="fade-in">
    <div class="max-w-3xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li>
                    <a href="{{ route('users.index') }}" class="hover:text-purple-600 transition-colors">
                        <i class="fas fa-users"></i> Usuários
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-gray-400 text-xs"></i></li>
                <li class="text-purple-600 font-medium">Editar {{ $user->name }}</li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-blue-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                            <span class="text-white font-bold text-lg">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </span>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        </div>
                    </div>
                    @if($user->role === 'admin')
                        <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                            <i class="fas fa-user-shield mr-1.5"></i>
                            Administrador
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            <i class="fas fa-user mr-1.5"></i>
                            Usuário
                        </span>
                    @endif
                </div>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-gray-400 mr-1"></i>
                        Nome Completo <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $user->name) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror" 
                        placeholder="Digite o nome completo"
                        required
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-1"></i>
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror" 
                        placeholder="usuario@exemplo.com"
                        required
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user-tag text-gray-400 mr-1"></i>
                        Função <span class="text-red-500">*</span>
                    </label>
                    <select 
                        name="role" 
                        id="role" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('role') border-red-500 @enderror"
                        required
                    >
                        <option value="">Selecione uma função</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrador (Acesso Total)</option>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Usuário (Acesso Limitado)</option>
                    </select>
                    <p class="mt-1 text-xs text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Administradores têm acesso total ao sistema, incluindo gerenciamento de usuários
                    </p>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Section -->
                <div class="pt-4 border-t border-gray-200">
                    <h3 class="text-md font-medium text-gray-800 mb-4">
                        <i class="fas fa-key text-gray-400 mr-2"></i>
                        Alterar Senha
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                        Deixe em branco se não quiser alterar a senha
                    </p>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-1"></i>
                            Nova Senha
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror" 
                            placeholder="Mínimo 6 caracteres (opcional)"
                        >
                        @error('password')
                            <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-1"></i>
                            Confirmar Nova Senha
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                            placeholder="Digite a senha novamente"
                        >
                    </div>
                </div>

                <!-- Warning for Self-Edit -->
                @if($user->id === Auth::id())
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-600 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800 mb-1">Atenção!</h3>
                            <p class="text-sm text-yellow-700">
                                Você está editando sua própria conta. Se remover seus privilégios de administrador, não poderá recuperá-los sozinho.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- User Info -->
                <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-600">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="font-medium text-gray-700">Criado em:</span>
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Última atualização:</span>
                            {{ $user->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <a href="{{ route('users.index') }}" 
                       class="btn-secondary px-6 py-2.5 rounded-lg text-white font-medium shadow-sm hover:shadow-md transition-all inline-flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        Voltar
                    </a>
                    <div class="flex items-center gap-3">
                        @if($user->id !== Auth::id())
                        <form action="{{ route('users.destroy', $user->id) }}" 
                              method="POST" 
                              class="inline-block"
                              onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.');">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="px-6 py-2.5 bg-red-600 rounded-lg text-white font-medium shadow-sm hover:shadow-md hover:bg-red-700 transition-all inline-flex items-center gap-2">
                                <i class="fas fa-trash"></i>
                                Excluir
                            </button>
                        </form>
                        @endif
                        <button 
                            type="submit" 
                            class="btn-primary px-6 py-2.5 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            Salvar Alterações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Form validation feedback
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Salvando...';
        
        // Re-enable if there's an error
        setTimeout(() => {
            if (submitBtn.disabled) {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        }, 5000);
    });

    // Password confirmation validation
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');

    passwordInput.addEventListener('input', function() {
        if (this.value) {
            passwordConfirmInput.required = true;
        } else {
            passwordConfirmInput.required = false;
        }
    });

    passwordConfirmInput.addEventListener('input', function() {
        if (passwordInput.value && this.value !== passwordInput.value) {
            this.setCustomValidity('As senhas não coincidem');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
@endsection

