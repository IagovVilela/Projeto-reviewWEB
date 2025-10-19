# 🌐 Guia de Compartilhamento com Ngrok

## 🚀 **Configuração do Ngrok**

### **1. Instalação**
```bash
# Windows (via Chocolatey)
choco install ngrok

# Ou baixar diretamente de: https://ngrok.com/download
```

### **2. Configuração**
```bash
# 1. Criar conta em: https://ngrok.com
# 2. Obter authtoken
ngrok config add-authtoken SEU_AUTHTOKEN

# 3. Expor aplicação local
ngrok http 8000
```

### **3. Compartilhamento**
```bash
# Ngrok gera URLs como:
# https://abc123.ngrok.io → http://localhost:8000
# https://def456.ngrok.io → http://localhost:8000

# Compartilhar com parceiro:
# "Acesse: https://abc123.ngrok.io"
```

## 🔧 **Configuração Avançada**

### **A. Ngrok com Domínio Personalizado**
```bash
# ngrok.yml
version: "2"
authtoken: SEU_AUTHTOKEN
tunnels:
  reviews-platform:
    proto: http
    addr: 8000
    subdomain: reviews-platform-dev
    region: us
```

### **B. Script de Inicialização**
```bash
# start-ngrok.bat (Windows)
@echo off
echo 🚀 Iniciando Reviews Platform...
start "Laravel" php artisan serve
timeout /t 3
echo 🌐 Expondo via Ngrok...
ngrok http 8000
```

## 📊 **Monitoramento**

### **Dashboard do Ngrok**
```bash
# Acessar: http://localhost:4040
# Ver requisições em tempo real
# Inspecionar tráfego HTTP/HTTPS
# Debug de problemas
```

## 🎯 **Vantagens do Ngrok**

✅ **Sem configuração de servidor**
✅ **HTTPS automático**
✅ **URLs públicas temporárias**
✅ **Inspeção de tráfego**
✅ **Webhooks para testes**
✅ **Gratuito para uso básico**

## 🔄 **Workflow com Ngrok**

### **1. Desenvolvimento Local**
```bash
# Desenvolvedor 1:
php artisan serve
ngrok http 8000
# Compartilha URL: https://abc123.ngrok.io
```

### **2. Testes Compartilhados**
```bash
# Desenvolvedor 2:
# Acessa: https://abc123.ngrok.io
# Testa funcionalidades
# Reporta bugs via chat/email
```

### **3. Demonstração**
```bash
# Para cliente/stakeholder:
# Compartilha URL temporária
# Demonstra funcionalidades
# Coleta feedback
```

## 🛠️ **Integração com Laravel**

### **Configuração de URL Dinâmica**
```php
// config/app.php
'url' => env('APP_URL', 'http://localhost:8000'),

// .env
APP_URL=https://abc123.ngrok.io
```

### **Middleware para Ngrok**
```php
// app/Http/Middleware/TrustNgrok.php
class TrustNgrok
{
    public function handle($request, Closure $next)
    {
        if ($request->header('x-forwarded-proto') === 'https') {
            $request->server->set('HTTPS', 'on');
        }
        
        return $next($request);
    }
}
```

## 📋 **Comandos Úteis**

```bash
# Iniciar com configuração específica
ngrok http 8000 --region=us --subdomain=reviews-dev

# Expor múltiplas portas
ngrok start reviews-platform api

# Com autenticação básica
ngrok http 8000 --basic-auth="user:pass"

# Com headers customizados
ngrok http 8000 --host-header="localhost:8000"
```

## 🎉 **Resultado Final**

Com Ngrok, vocês podem:
- ✅ Desenvolver localmente
- ✅ Compartilhar URLs públicas instantaneamente
- ✅ Testar em dispositivos móveis
- ✅ Demonstrar para clientes
- ✅ Colaborar em tempo real
- ✅ Evitar configurações complexas de servidor
