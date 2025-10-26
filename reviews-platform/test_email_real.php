<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\Company;
use App\Models\Review;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewReviewNotification;

echo "\n🧪 TESTANDO ENVIO DE EMAIL REAL\n";
echo str_repeat("=", 50) . "\n\n";

// Buscar empresa e avaliação
$company = Company::first();
$review = Review::first();

if (!$company) {
    echo "❌ Nenhuma empresa encontrada no banco!\n";
    echo "💡 Crie uma empresa primeiro: http://localhost:8000/companies/create\n";
    exit(1);
}

if (!$review) {
    echo "❌ Nenhuma avaliação encontrada no banco!\n";
    echo "💡 Crie uma avaliação através da página pública: http://localhost:8000/r/{token}\n";
    exit(1);
}

echo "📧 Empresa: {$company->name}\n";
echo "⭐ Avaliação: {$review->rating} estrelas\n";
echo "📱 WhatsApp: {$review->whatsapp}\n";
echo "💬 Comentário: " . ($review->comment ? $review->comment : 'Sem comentário') . "\n\n";

echo "📤 Enviando email para: iagovventura@gmail.com...\n\n";

try {
    Mail::to('iagovventura@gmail.com')->send(new NewReviewNotification($company, $review));
    
    echo "✅ EMAIL ENVIADO COM SUCESSO!\n\n";
    echo "📬 Verifique sua caixa de entrada: iagovventura@gmail.com\n";
    echo "📪 Não esqueça de verificar a pasta SPAM/LIXO ELETRÔNICO também.\n\n";
    
} catch (\Exception $e) {
    echo "❌ ERRO AO ENVIAR EMAIL:\n";
    echo "   " . $e->getMessage() . "\n\n";
    echo "💡 POSSÍVEIS CAUSAS:\n";
    echo "   1. Senha de app incorreta\n";
    echo "   2. Verificação em duas etapas desativada\n";
    echo "   3. Gmail bloqueando login de apps menos seguros\n";
    echo "   4. Porta 587 bloqueada pelo firewall\n\n";
    echo "📝 VERIFIQUE A CONFIGURAÇÃO NO .env:\n";
    echo "   MAIL_HOST=smtp.gmail.com\n";
    echo "   MAIL_PORT=587\n";
    echo "   MAIL_USERNAME=iagovventura@gmail.com\n";
    echo "   MAIL_PASSWORD=xnsmjhzucdroeopd\n";
    echo "   MAIL_ENCRYPTION=tls\n";
}

echo "\n" . str_repeat("=", 50) . "\n";
echo "✨ Teste concluído!\n\n";

