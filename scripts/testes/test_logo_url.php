<?php

require __DIR__ . '/../../reviews-platform/vendor/autoload.php';

$app = require_once __DIR__ . '/../../reviews-platform/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Teste de URL da Logo ===\n\n";

// Buscar primeira empresa
$company = \App\Models\Company::first();

if (!$company) {
    echo "❌ Nenhuma empresa encontrada\n";
    exit(1);
}

echo "✅ Empresa encontrada: {$company->name}\n";
echo "Logo no banco: " . ($company->logo ?? 'null') . "\n\n";

if (!$company->logo) {
    echo "⚠️  Empresa não tem logo cadastrada\n";
    exit(0);
}

// Testar URLs
echo "=== URLs Geradas ===\n";
echo "logo_url: " . ($company->logo_url ?? 'null') . "\n";
echo "full_logo_url: " . ($company->full_logo_url ?? 'null') . "\n\n";

// Testar URL completa
echo "=== Teste de Acessibilidade ===\n";
$url = $company->full_logo_url;
echo "URL completa: $url\n";

// Verificar se arquivo existe
$storagePath = storage_path('app/public/' . $company->logo);
$fileExists = file_exists($storagePath);
echo "Arquivo existe em storage: " . ($fileExists ? '✅ SIM' : '❌ NÃO') . "\n";
echo "Caminho: $storagePath\n\n";

// Verificar link simbólico
$publicPath = public_path('storage/' . $company->logo);
$linkExists = file_exists($publicPath);
echo "Link simbólico funciona: " . ($linkExists ? '✅ SIM' : '❌ NÃO') . "\n";
echo "Caminho público: $publicPath\n\n";

// Verificar permissões
if ($fileExists) {
    $permissions = substr(sprintf('%o', fileperms($storagePath)), -4);
    echo "Permissões do arquivo: $permissions\n";
}

echo "\n=== Recomendações ===\n";
if (!$fileExists) {
    echo "❌ Arquivo não existe! Faça upload da logo novamente.\n";
} elseif (!$linkExists) {
    echo "❌ Link simbólico não existe! Execute: php artisan storage:link\n";
} else {
    echo "✅ Tudo OK! A logo deve funcionar nos emails.\n";
}

