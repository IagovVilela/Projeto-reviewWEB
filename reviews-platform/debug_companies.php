<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Company;

echo "=== EMPRESAS NO BANCO DE DADOS ===\n\n";

$companies = Company::all();

if ($companies->count() == 0) {
    echo "NENHUMA EMPRESA ENCONTRADA!\n";
} else {
    foreach ($companies as $company) {
        echo "Nome: " . $company->name . "\n";
        echo "Token: " . $company->token . "\n";
        echo "Criado em: " . $company->created_at . "\n";
        echo "Ativo: " . ($company->is_active ? 'SIM' : 'NÃO') . "\n";
        echo "---\n";
    }
}

echo "\n=== VERIFICANDO TOKEN ESPECÍFICO ===\n";
$specificToken = 'preview_hjkhqk8df';
$company = Company::where('token', $specificToken)->first();

if ($company) {
    echo "Empresa encontrada com token '$specificToken':\n";
    echo "Nome: " . $company->name . "\n";
    echo "Token: " . $company->token . "\n";
} else {
    echo "NENHUMA empresa encontrada com token '$specificToken'\n";
}
