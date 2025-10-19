<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Review;
use App\Models\Company;

echo "=== VERIFICAÇÃO DE DADOS ===\n";
echo "Total de empresas: " . Company::count() . "\n";
echo "Total de avaliações: " . Review::count() . "\n\n";

if (Review::count() > 0) {
    echo "=== DETALHES DAS AVALIAÇÕES ===\n";
    $reviews = Review::with('company')->get();
    
    foreach ($reviews as $review) {
        echo "ID: " . $review->id . "\n";
        echo "Empresa: " . $review->company->name . "\n";
        echo "Nota: " . $review->rating . "/5\n";
        echo "WhatsApp: " . $review->whatsapp . "\n";
        echo "Comentário: " . ($review->comment ?: 'Nenhum') . "\n";
        echo "Positiva: " . ($review->is_positive ? 'Sim' : 'Não') . "\n";
        echo "Data: " . $review->created_at . "\n";
        echo "Processada: " . ($review->is_processed ? 'Sim' : 'Não') . "\n";
        echo "---\n";
    }
}

echo "\n=== EMPRESAS ===\n";
$companies = Company::all();
foreach ($companies as $company) {
    echo "ID: " . $company->id . " | Nome: " . $company->name . " | Token: " . $company->token . "\n";
}
