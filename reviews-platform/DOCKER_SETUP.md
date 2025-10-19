# Configuração Docker para Reviews Platform

## 🐳 **CONFIGURAÇÃO COMPLETA DO DOCKER**

### **1. Arquivos Necessários:**

#### **A. docker-compose.yml** (já criado)
#### **B. Dockerfile** (já criado)
#### **C. .dockerignore** (já criado)

### **2. Configuração do .env para Docker:**

```env
APP_NAME="Reviews Platform"
APP_ENV=local
APP_KEY=base64:your-app-key-here
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration for Docker
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=reviews_platform
DB_USERNAME=reviews_user
DB_PASSWORD=reviews_pass

# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@reviewsplatform.com
MAIL_FROM_NAME="${APP_NAME}"
```

### **3. Comandos para Iniciar:**

```bash
# 1. Copiar configuração Docker para .env
cp .env.docker .env

# 2. Iniciar containers
docker-compose up -d

# 3. Verificar status
docker-compose ps

# 4. Ver logs
docker-compose logs -f app
```

### **4. Comandos Úteis:**

```bash
# Parar containers
docker-compose down

# Rebuild containers
docker-compose up --build

# Acessar container da aplicação
docker-compose exec app bash

# Acessar MySQL
docker-compose exec mysql mysql -u reviews_user -p reviews_platform

# Ver logs específicos
docker-compose logs app
docker-compose logs mysql
```

### **5. URLs de Acesso:**

- **Aplicação:** http://localhost:8000
- **MySQL:** localhost:3306
- **Redis:** localhost:6379

### **6. Para Desenvolvimento em Equipe:**

```bash
# Desenvolvedor 1:
git clone https://github.com/IagovVilela/Projeto-reviewWEB.git
cd Projeto-reviewWEB
cp .env.docker .env
docker-compose up -d

# Desenvolvedor 2:
git clone https://github.com/IagovVilela/Projeto-reviewWEB.git
cd Projeto-reviewWEB
cp .env.docker .env
docker-compose up -d
```

### **7. Sincronização de Dados:**

```bash
# Quando houver mudanças no banco:
docker-compose exec app php artisan migrate

# Para compartilhar dados de teste:
docker-compose exec app php artisan db:seed
```

### **8. Backup do Banco:**

```bash
# Exportar dados
docker-compose exec mysql mysqldump -u reviews_user -p reviews_platform > backup.sql

# Importar dados
docker-compose exec -T mysql mysql -u reviews_user -p reviews_platform < backup.sql
```
