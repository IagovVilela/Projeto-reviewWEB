<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cadastrar Nova Empresa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                
                <form action="{{ route('admin.companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nome da Empresa --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nome da Empresa *
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- E-mail --}}
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            E-mail de Contato *
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                        <p class="text-xs text-gray-500 mt-1">E-mail para receber as notificações de avaliações</p>
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Logo --}}
                    <div class="mb-4">
                        <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                            Logo da Empresa
                        </label>
                        <input type="file" 
                               name="logo" 
                               id="logo" 
                               accept="image/*"
                               class="w-full">
                        <p class="text-xs text-gray-500 mt-1">Formatos: JPG, PNG, WEBP. Máximo: 2MB</p>
                        @error('logo')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Imagem de Fundo --}}
                    <div class="mb-4">
                        <label for="background_image" class="block text-sm font-medium text-gray-700 mb-2">
                            Imagem de Fundo
                        </label>
                        <input type="file" 
                               name="background_image" 
                               id="background_image" 
                               accept="image/*"
                               class="w-full">
                        <p class="text-xs text-gray-500 mt-1">Formatos: JPG, PNG, WEBP. Máximo: 5MB</p>
                        @error('background_image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- URL do Google Reviews --}}
                    <div class="mb-4">
                        <label for="google_review_url" class="block text-sm font-medium text-gray-700 mb-2">
                            URL do Google Reviews *
                        </label>
                        <input type="url" 
                               name="google_review_url" 
                               id="google_review_url" 
                               value="{{ old('google_review_url') }}"
                               placeholder="https://g.page/..."
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Link direto para avaliação no Google</p>
                        @error('google_review_url')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Threshold de Avaliação Positiva --}}
                    <div class="mb-6">
                        <label for="positive_threshold" class="block text-sm font-medium text-gray-700 mb-2">
                            Limite de Avaliação Positiva: <span id="threshold-value" class="font-bold">4</span> estrelas
                        </label>
                        <input type="range" 
                               name="positive_threshold" 
                               id="positive_threshold" 
                               min="1" 
                               max="5" 
                               value="{{ old('positive_threshold', 4) }}"
                               class="w-full">
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>1 ⭐</span>
                            <span>2 ⭐</span>
                            <span>3 ⭐</span>
                            <span>4 ⭐</span>
                            <span>5 ⭐</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Avaliações ≥ este valor serão consideradas positivas e redirecionadas ao Google
                        </p>
                        @error('positive_threshold')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Botões --}}
                    <div class="flex gap-3">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                            Criar Empresa
                        </button>
                        <a href="{{ route('admin.companies.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        const slider = document.getElementById('positive_threshold');
        const valueDisplay = document.getElementById('threshold-value');
        
        slider.addEventListener('input', function() {
            valueDisplay.textContent = this.value;
        });
    </script>
</x-app-layout>

