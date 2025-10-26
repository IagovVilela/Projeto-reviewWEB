<?php

/**
 * Script de Teste de Email
 * Execute: php test_email.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\Company;
use App\Models\Review;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewReviewNotification;

echo "🧪 Testando envio de email...\n\n";

// Buscar primeira empresa e avaliação
$company = Company::first();
$review = Review::first();

if (!$company) {
    echo "❌ Nenhuma empresa encontrada!\n";
    exit(1);
}

if (!$review) {
    echo "❌ Nenhuma avaliação encontrada!\n";
    echo "💡 Crie uma avaliação primeiro através da interface web.\n";
    exit(1);
}

echo "📧 Empresa: {$company->name}\n";
echo "⭐ Avaliação: {$review->rating} estrelas\n";
echo "📱 WhatsApp: {$review->whatsapp}\n\n";

echo "📤 Enviando email de teste...\n";

try {
    // Substitua pelo seu email de teste
    $testEmail = env('TEST_EMAIL', 'teste@example.com');
    
    Mail::to($testEmail)->send(new NewReviewNotification($company, $review));
    
    echo "✅ Email enviado com sucesso!\n";
    echo "📬 Verifique a caixa de entrada de: {$testEmail}\n";
    
} catch (\Exception $e) {
    echo "❌ Erro ao enviar email:\n";
    echo $e->getMessage() . "\n\n";
    echo "💡 Verifique a configuração no .env:\n";
    echo "   - MAIL_HOST\n";
    echo "   - MAIL_PORT\n";
    echo "   - MAIL_USERNAME\n";
    echo "   - MAIL_PASSWORD\n";
    echo "   - MAIL_FROM_ADDRESS\n";
}

echo "\n✨ Teste concluído!\n";

