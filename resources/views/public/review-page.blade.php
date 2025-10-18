<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avalie {{ $reviewPage->company->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .star {
            cursor: pointer;
            font-size: 3rem;
            color: #D1D5DB;
            transition: all 0.2s;
        }
        .star.active,
        .star:hover {
            color: #FCD34D;
            transform: scale(1.1);
        }
        body {
            background-image: url('{{ $reviewPage->company->background_image_url }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    
    <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 max-w-md w-full">
        
        {{-- Logo --}}
        @if($reviewPage->company->logo_url)
        <div class="flex justify-center mb-6">
            <img src="{{ $reviewPage->company->logo_url }}" 
                 alt="{{ $reviewPage->company->name }}" 
                 class="h-20 object-contain">
        </div>
        @endif

        {{-- Título --}}
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Como foi sua experiência?
        </h1>
        <p class="text-center text-gray-600 mb-8">
            Avalie {{ $reviewPage->company->name }}
        </p>

        {{-- Formulário Principal --}}
        <form id="reviewForm" class="space-y-6">
            @csrf

            {{-- WhatsApp --}}
            <div>
                <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                    Seu WhatsApp
                </label>
                <input type="tel" 
                       id="whatsapp" 
                       name="whatsapp" 
                       placeholder="(11) 98765-4321"
                       class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required>
                <p class="text-xs text-gray-500 mt-1">Para podermos entrar em contato, se necessário</p>
            </div>

            {{-- Avaliação por Estrelas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3 text-center">
                    Sua avaliação
                </label>
                <div class="flex justify-center gap-2" id="stars">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
                <input type="hidden" id="rating" name="rating" required>
                <p id="rating-error" class="text-red-600 text-sm mt-2 text-center hidden">
                    Por favor, selecione uma nota
                </p>
            </div>

            {{-- Comentário Opcional --}}
            <div id="commentSection" class="hidden">
                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                    Comentário (opcional)
                </label>
                <textarea id="comment" 
                          name="comment" 
                          rows="3"
                          placeholder="Conte-nos mais sobre sua experiência..."
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            </div>

            {{-- Botão de Envio --}}
            <button type="submit" 
                    id="submitBtn"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition disabled:bg-gray-400 disabled:cursor-not-allowed">
                Enviar Avaliação
            </button>
        </form>

        {{-- Formulário de Feedback (oculto inicialmente) --}}
        <div id="feedbackForm" class="hidden">
            <div class="text-center mb-6">
                <div class="text-5xl mb-3">😔</div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    Sentimos muito pela experiência!
                </h2>
                <p class="text-gray-600">
                    Por favor, nos conte o que aconteceu para podermos melhorar
                </p>
            </div>

            <form id="feedbackFormSubmit">
                @csrf
                <input type="hidden" id="review_id" name="review_id">
                
                <textarea id="feedback" 
                          name="feedback" 
                          rows="5"
                          placeholder="Descreva o que não saiu como esperado..."
                          class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent mb-4"
                          required></textarea>

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Enviar Feedback
                </button>
            </form>
        </div>

        {{-- Mensagem de Sucesso (oculta inicialmente) --}}
        <div id="successMessage" class="hidden text-center">
            <div class="text-6xl mb-4">✅</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-3">
                Obrigado pelo seu feedback!
            </h2>
            <p class="text-gray-600">
                Sua opinião é muito importante para nós e entraremos em contato em breve.
            </p>
        </div>

    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');
        const ratingError = document.getElementById('rating-error');
        const commentSection = document.getElementById('commentSection');
        const reviewForm = document.getElementById('reviewForm');
        const feedbackFormDiv = document.getElementById('feedbackForm');
        const feedbackFormSubmit = document.getElementById('feedbackFormSubmit');
        const successMessage = document.getElementById('successMessage');
        const submitBtn = document.getElementById('submitBtn');

        let selectedRating = 0;
        const threshold = {{ $reviewPage->company->positive_threshold }};

        // Sistema de estrelas
        stars.forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.value);
                ratingInput.value = selectedRating;
                ratingError.classList.add('hidden');
                updateStars(selectedRating);
                commentSection.classList.remove('hidden');
            });

            star.addEventListener('mouseenter', function() {
                updateStars(parseInt(this.dataset.value));
            });
        });

        document.getElementById('stars').addEventListener('mouseleave', function() {
            updateStars(selectedRating);
        });

        function updateStars(rating) {
            stars.forEach(star => {
                if (parseInt(star.dataset.value) <= rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        // Envio da avaliação
        reviewForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (!selectedRating) {
                ratingError.classList.remove('hidden');
                return;
            }

            const whatsapp = document.getElementById('whatsapp').value;
            const comment = document.getElementById('comment').value;

            submitBtn.disabled = true;
            submitBtn.textContent = 'Enviando...';

            try {
                const response = await fetch('{{ route("review.store", $reviewPage->public_token) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        rating: selectedRating,
                        whatsapp: whatsapp,
                        comment: comment
                    })
                });

                const data = await response.json();

                if (data.success) {
                    if (data.redirect_to_google) {
                        // Avaliação positiva - redirecionar ao Google
                        window.location.href = data.google_url;
                    } else {
                        // Avaliação negativa - mostrar formulário de feedback
                        document.getElementById('review_id').value = data.review_id;
                        reviewForm.classList.add('hidden');
                        feedbackFormDiv.classList.remove('hidden');
                    }
                }
            } catch (error) {
                alert('Erro ao enviar avaliação. Tente novamente.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Enviar Avaliação';
            }
        });

        // Envio do feedback
        feedbackFormSubmit.addEventListener('submit', async function(e) {
            e.preventDefault();

            const feedback = document.getElementById('feedback').value;
            const reviewId = document.getElementById('review_id').value;

            try {
                const response = await fetch('{{ route("review.feedback", $reviewPage->public_token) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        review_id: reviewId,
                        feedback: feedback
                    })
                });

                const data = await response.json();

                if (data.success) {
                    feedbackFormDiv.classList.add('hidden');
                    successMessage.classList.remove('hidden');
                }
            } catch (error) {
                alert('Erro ao enviar feedback. Tente novamente.');
            }
        });

        // Máscara de telefone
        document.getElementById('whatsapp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length <= 11) {
                value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
                value = value.replace(/(\d)(\d{4})$/, '$1-$2');
            }
            
            e.target.value = value;
        });
    </script>

</body>
</html>

