<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Company;

echo "=== VERIFICAÇÃO DE EMPRESAS ===\n\n";

$companies = Company::all();

foreach ($companies as $company) {
    echo "Empresa: " . $company->name . "\n";
    echo "Token: " . $company->token . "\n";
    echo "Logo: " . ($company->logo ?: 'NENHUM') . "\n";
    echo "Background: " . ($company->background_image ?: 'NENHUM') . "\n";
    echo "URL Pública: " . $company->public_url . "\n";
    echo "---\n";
}

echo "\n=== VERIFICAÇÃO DE ARQUIVOS ===\n\n";

// Verificar se os arquivos existem
foreach ($companies as $company) {
    if ($company->logo) {
        $logoPath = storage_path('app/public/' . $company->logo);
        echo "Logo de {$company->name}: " . (file_exists($logoPath) ? 'EXISTE' : 'NÃO EXISTE') . " - {$logoPath}\n";
    }
    
    if ($company->background_image) {
        $bgPath = storage_path('app/public/' . $company->background_image);
        echo "Background de {$company->name}: " . (file_exists($bgPath) ? 'EXISTE' : 'NÃO EXISTE') . " - {$bgPath}\n";
    }
}
