<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ESTRUTURA DA TABELA COMPANIES ===\n\n";

$columns = DB::select('DESCRIBE companies');

foreach ($columns as $col) {
    echo $col->Field . " - " . $col->Type . "\n";
}

echo "\n=== VERIFICANDO SE CAMPO 'url' EXISTE ===\n";

$hasUrlField = false;
foreach ($columns as $col) {
    if ($col->Field === 'url') {
        $hasUrlField = true;
        break;
    }
}

if ($hasUrlField) {
    echo "✅ Campo 'url' EXISTE na tabela\n";
} else {
    echo "❌ Campo 'url' NÃO EXISTE na tabela\n";
    echo "\n=== ADICIONANDO CAMPO 'url' MANUALMENTE ===\n";
    
    try {
        DB::statement('ALTER TABLE companies ADD COLUMN url VARCHAR(255) NULL AFTER name');
        echo "✅ Campo 'url' adicionado com sucesso!\n";
    } catch (Exception $e) {
        echo "❌ Erro ao adicionar campo: " . $e->getMessage() . "\n";
    }
}
