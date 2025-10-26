<div class="relative">
    <select 
        id="languageSelector" 
        class="appearance-none bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg px-3 py-2 pr-8 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent cursor-pointer transition-colors"
    >
        <option value="pt_BR" {{ app()->getLocale() === 'pt_BR' ? 'selected' : '' }}>
            🇧🇷 Português
        </option>
        <option value="en_US" {{ app()->getLocale() === 'en_US' ? 'selected' : '' }}>
            🇺🇸 English
        </option>
    </select>
    
    <!-- Ícone de seta customizado -->
    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
        <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selector = document.getElementById('languageSelector');
    
    if (selector) {
        selector.addEventListener('change', function() {
            const locale = this.value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            
            // Trocar idioma
            fetch('/change-locale', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ locale: locale })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recarregar página com o novo idioma
                    window.location.reload();
                } else {
                    console.error('Erro ao trocar idioma');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
            });
        });
    }
});
</script>

