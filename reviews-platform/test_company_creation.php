<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Company;

echo "=== TESTE DE CRIAÇÃO DE EMPRESA ===\n\n";

// Dados de teste
$testData = [
    'name' => 'Empresa Teste',
    'negative_email' => 'teste@empresa.com',
    'positive_score' => 4,
    'is_active' => true
];

try {
    $company = Company::create($testData);
    echo "✅ Empresa criada com sucesso!\n";
    echo "Nome: " . $company->name . "\n";
    echo "Token: " . $company->token . "\n";
    echo "URL Pública: " . $company->public_url . "\n";
} catch (Exception $e) {
    echo "❌ Erro ao criar empresa: " . $e->getMessage() . "\n";
}

echo "\n=== EMPRESAS ATUAIS ===\n";
$companies = Company::all();
foreach ($companies as $company) {
    echo "Nome: " . $company->name . " - Token: " . $company->token . "\n";
}

