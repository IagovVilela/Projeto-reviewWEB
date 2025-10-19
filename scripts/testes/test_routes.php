<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

echo "=== TESTE DE ROTAS API ===\n";

// Teste 1: Verificar se as rotas estão registradas
echo "1. Verificando rotas registradas:\n";
$routes = Route::getRoutes();
foreach ($routes as $route) {
    if (strpos($route->uri(), 'api/') === 0) {
        echo "   " . $route->methods()[0] . " " . $route->uri() . " -> " . $route->getActionName() . "\n";
    }
}

echo "\n2. Testando rota /api/companies:\n";

try {
    // Simular uma requisição para a rota API
    $request = Request::create('/api/companies', 'GET');
    $request->headers->set('Accept', 'application/json');
    
    $response = $app->handle($request);
    
    echo "   Status: " . $response->getStatusCode() . "\n";
    echo "   Content-Type: " . $response->headers->get('Content-Type') . "\n";
    echo "   Content (primeiros 200 chars): " . substr($response->getContent(), 0, 200) . "...\n";
    
} catch (\Exception $e) {
    echo "   ERRO: " . $e->getMessage() . "\n";
}

echo "\n3. Testando rota /api/reviews:\n";

try {
    $request = Request::create('/api/reviews', 'GET');
    $request->headers->set('Accept', 'application/json');
    
    $response = $app->handle($request);
    
    echo "   Status: " . $response->getStatusCode() . "\n";
    echo "   Content-Type: " . $response->headers->get('Content-Type') . "\n";
    echo "   Content (primeiros 200 chars): " . substr($response->getContent(), 0, 200) . "...\n";
    
} catch (\Exception $e) {
    echo "   ERRO: " . $e->getMessage() . "\n";
}
