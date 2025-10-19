# 🌐 CONFIGURAÇÃO DE BANCO COMPARTILHADO

## 🚀 **OPÇÕES DE BANCO EM NUVEM**

### **1. PlanetScale (Recomendado - Gratuito)**
```bash
# 1. Criar conta em: https://planetscale.com
# 2. Criar banco "reviews-platform"
# 3. Obter string de conexão
# 4. Configurar no .env de ambos
```

**Configuração:**
```env
DB_CONNECTION=mysql
DB_HOST=aws.connect.psdb.cloud
DB_PORT=3306
DB_DATABASE=reviews-platform
DB_USERNAME=seu-usuario
DB_PASSWORD=sua-senha
DB_SSL_CA=/path/to/cert.pem
```

### **2. Railway (Alternativa)**
```bash
# 1. Criar conta em: https://railway.app
# 2. Deploy MySQL
# 3. Obter variáveis de conexão
```

### **3. Supabase (PostgreSQL)**
```bash
# 1. Criar conta em: https://supabase.com
# 2. Criar projeto
# 3. Usar PostgreSQL (compatível com Laravel)
```

## 🔧 **CONFIGURAÇÃO LOCAL COMPARTILHADA**

### **Opção 1: Docker Compose**
```yaml
# docker-compose.yml
version: '3.8'
services:
  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: reviews_platform
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - app-network

  app:
    build: .
    ports:
      - "8000:8000"
    depends_on:
      - mysql
    environment:
      DB_HOST: mysql
      DB_DATABASE: reviews_platform
      DB_USERNAME: root
      DB_PASSWORD: root
    networks:
      - app-network

volumes:
  mysql_data:

networks:
  app-network:
```

### **Opção 2: XAMPP/WAMP Compartilhado**
```bash
# 1. Instalar XAMPP em um servidor local
# 2. Configurar MySQL para aceitar conexões externas
# 3. Compartilhar IP do servidor
# 4. Ambos conectam no mesmo banco
```

## 📋 **CONFIGURAÇÃO DO .ENV COMPARTILHADO**

### **Arquivo .env.example**
```env
APP_NAME="Reviews Platform"
APP_ENV=local
APP_KEY=base64:your-app-key-here
APP_DEBUG=true
APP_URL=http://localhost:8000

# Banco Compartilhado
DB_CONNECTION=mysql
DB_HOST=seu-host-compartilhado
DB_PORT=3306
DB_DATABASE=reviews_platform
DB_USERNAME=usuario_compartilhado
DB_PASSWORD=senha_compartilhada

# Email Compartilhado
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email-compartilhado@gmail.com
MAIL_PASSWORD=senha-de-app-compartilhada
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@reviewsplatform.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🔄 **WORKFLOW DE DESENVOLVIMENTO**

### **1. Desenvolvimento Paralelo**
```bash
# Ambos fazem:
git clone https://github.com/IagovVilela/Projeto-reviewWEB.git
cd Projeto-reviewWEB
cp .env.example .env
# Configurar .env com banco compartilhado
composer install
php artisan migrate
php artisan serve
```

### **2. Sincronização de Código**
```bash
# Antes de começar a trabalhar:
git pull origin main

# Após fazer alterações:
git add .
git commit -m "feat: nova funcionalidade"
git push origin main

# Parceiro faz:
git pull origin main
```

### **3. Sincronização de Banco**
```bash
# Quando houver mudanças no banco:
php artisan migrate

# Para compartilhar dados de teste:
php artisan db:seed
```

## 🛠️ **FERRAMENTAS RECOMENDADAS**

### **1. GitHub Actions (CI/CD)**
```yaml
# .github/workflows/deploy.yml
name: Deploy to Production
on:
  push:
    branches: [main]
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Deploy
        run: |
          # Scripts de deploy automático
```

### **2. Docker para Ambiente Consistente**
```dockerfile
# Dockerfile
FROM php:8.0-fpm
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html
WORKDIR /var/www/html
RUN composer install
```

### **3. Ngrok para Compartilhamento Local**
```bash
# Instalar ngrok
npm install -g ngrok

# Expor aplicação local
ngrok http 8000

# Compartilhar URL: https://abc123.ngrok.io
```

## 📊 **MONITORAMENTO COMPARTILHADO**

### **1. Logs Compartilhados**
```php
// config/logging.php
'channels' => [
    'shared' => [
        'driver' => 'daily',
        'path' => storage_path('logs/shared.log'),
    ],
],
```

### **2. Dashboard de Status**
```php
// Criar rota de status
Route::get('/status', function() {
    return response()->json([
        'database' => DB::connection()->getPdo() ? 'OK' : 'ERROR',
        'last_update' => now(),
        'version' => '2.0.0'
    ]);
});
```

## 🎯 **RECOMENDAÇÃO FINAL**

### **Para Máxima Eficiência:**

1. **Use PlanetScale** para banco compartilhado (gratuito)
2. **GitHub Codespaces** para ambiente de desenvolvimento
3. **Docker** para consistência local
4. **Ngrok** para testes em tempo real

### **Configuração Rápida:**
```bash
# 1. Criar banco no PlanetScale
# 2. Configurar .env com credenciais do PlanetScale
# 3. Ambos fazem: git clone + composer install
# 4. Ambos fazem: php artisan migrate
# 5. Pronto para desenvolvimento compartilhado!
```

## 🔗 **LINKS ÚTEIS**

- **PlanetScale:** https://planetscale.com
- **GitHub Codespaces:** https://github.com/codespaces
- **Railway:** https://railway.app
- **Supabase:** https://supabase.com
- **Ngrok:** https://ngrok.com
