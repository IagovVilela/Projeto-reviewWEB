@extends('layouts.admin')

@section('title', 'Criar Novo Usuário')
@section('page-title', 'Criar Novo Usuário')
@section('page-description', 'Adicione um novo usuário ao sistema')

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
                <li class="text-purple-600 font-medium">Criar Novo</li>
            </ol>
        </nav>

        <!-- Form Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-50 to-blue-50">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Informações do Novo Usuário</h2>
                        <p class="text-sm text-gray-600">Preencha os dados abaixo para criar um novo usuário</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('users.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

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
                        value="{{ old('name') }}"
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
                        value="{{ old('email') }}"
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
                        @if(Auth::user()->role === 'admin') disabled @endif
                    >
                        <option value="">{{ __('users.select_role') }}</option>
                        @if(Auth::user()->role === 'proprietario')
                            <option value="proprietario" {{ old('role') === 'proprietario' ? 'selected' : '' }}>{{ __('users.role_owner_full') }}</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>{{ __('users.role_admin_full') }}</option>
                        @endif
                        <option value="user" {{ old('role') === 'user' || Auth::user()->role === 'admin' ? 'selected' : '' }}>{{ __('users.role_user_limited') }}</option>
                    </select>
                    @if(Auth::user()->role === 'admin')
                        <input type="hidden" name="role" value="user">
                        <p class="mt-1 text-xs text-yellow-600">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Como administrador, você só pode criar usuários comuns.
                        </p>
                    @elseif(Auth::user()->role === 'proprietario')
                        <p class="mt-1 text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            {{ __('users.role_owner_info') }}
                        </p>
                    @endif
                    @error('role')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>
                        Senha <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror" 
                        placeholder="Mínimo 6 caracteres"
                        required
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>
                        Confirmar Senha <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all" 
                        placeholder="Digite a senha novamente"
                        required
                    >
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800 mb-1">Informações Importantes</h3>
                            <div class="text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>A senha deve ter no mínimo 6 caracteres</li>
                                    <li>O usuário receberá um email com suas credenciais de acesso</li>
                                    <li>Apenas administradores podem criar e gerenciar usuários</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('users.index') }}" 
                       class="btn-secondary px-6 py-2.5 rounded-lg text-white font-medium shadow-sm hover:shadow-md transition-all inline-flex items-center gap-2">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </a>
                    <button 
                        type="submit" 
                        class="btn-primary px-6 py-2.5 rounded-lg text-white font-medium shadow-md hover:shadow-lg transition-all inline-flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Criar Usuário
                    </button>
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
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Criando...';
    });

    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');

    passwordInput.addEventListener('input', function() {
        const strength = getPasswordStrength(this.value);
        // You can add visual feedback here
    });

    passwordConfirmInput.addEventListener('input', function() {
        if (this.value !== passwordInput.value) {
            this.setCustomValidity('As senhas não coincidem');
        } else {
            this.setCustomValidity('');
        }
    });

    function getPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 6) strength++;
        if (password.length >= 10) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^a-zA-Z\d]/.test(password)) strength++;
        return strength;
    }
</script>
@endsection

