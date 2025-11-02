# 🚀 Deploy no DigitalOcean App Platform

## Passo a Passo Completo

### 1. Preparar o Código

```bash
# Garantir que todas as dependências estão no composer.json
composer install --no-dev --optimize-autoloader

# Limpar cache local
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### 2. Criar Conta no DigitalOcean

1. Acesse: https://cloud.digitalocean.com
2. Crie uma conta (usando GitHub facilita)
3. Você receberá $200 créditos grátis por 60 dias

### 3. Criar App no DigitalOcean

1. No painel, clique em "Create" → "Apps"
2. Selecione "GitHub" e conecte seu repositório
3. Selecione o repositório e branch

### 4. Configurar Build

**Build Command:**
```bash
composer install --no-dev --optimize-autoloader && php artisan config:cache
```

**Run Command:**
```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 5. Adicionar Banco de Dados

1. Na tela de configuração, clique em "Add Resource"
2. Selecione "Database" → "MySQL"
3. Escolha o plano mais básico ($15/mês)
4. Aguarde criação (5-10 minutos)

### 6. Configurar Variáveis de Ambiente

Na seção "Environment Variables", adicione:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:SuaChaveAqui
APP_URL=https://seu-app.ondigitalocean.app

DB_CONNECTION=mysql
DB_HOST=${db.HOSTNAME}
DB_PORT=${db.PORT}
DB_DATABASE=${db.DATABASE}
DB_USERNAME=${db.USERNAME}
DB_PASSWORD=${db.PASSWORD}

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@seusite.com
MAIL_FROM_NAME="${APP_NAME}"

SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

**Importante:** `APP_KEY` - gere com:
```bash
php artisan key:generate --show
```

### 7. Configurar Storage

Adicione ao Run Command:
```bash
php artisan storage:link && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

Ou crie um script de startup em `deploy.sh`:
```bash
#!/bin/bash
php artisan storage:link
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 8. Configurar Cron para Schedule

Na seção "App-Level Settings" → "Components" → Seu App → "Settings":

Adicione um Component do tipo "Worker" com:
- **Run Command:** `php artisan schedule:work`
- Isso mantém o schedule rodando continuamente

### 9. Deploy!

1. Clique em "Review Settings"
2. Revise todas as configurações
3. Clique em "Create Resources"
4. Aguarde o deploy (5-10 minutos)

### 10. Pós-Deploy

Após o deploy, execute:

```bash
# Via terminal do DigitalOcean ou SSH
php artisan migrate
php artisan storage:link
php artisan config:cache
php artisan route:cache
```

### 11. Configurar Domínio Personalizado

1. No painel do app, vá em "Settings" → "Domains"
2. Adicione seu domínio
3. Configure DNS:
   - Tipo: CNAME
   - Nome: @ ou www
   - Valor: seu-app.ondigitalocean.app

### 12. Configurar SSL

O DigitalOcean configura SSL automaticamente via Let's Encrypt.

---

## 💰 Custos Estimados

- **App Basic:** $5/mês (512MB RAM)
- **Database Basic:** $15/mês (1GB SSD)
- **Total:** ~$20/mês

---

## 🔧 Troubleshooting

### Erro de Migração
- Verifique variáveis de banco de dados
- Execute manualmente: `php artisan migrate`

### Storage não funciona
- Execute: `php artisan storage:link`
- Verifique permissões

### Schedule não roda
- Configure Worker component com `php artisan schedule:work`

### E-mails não enviam
- Verifique configuração SMTP
- Teste com: `php artisan tinker` → `Mail::raw('test', function($m){$m->to('test@test.com')->subject('test');});`

---

## 📚 Recursos

- Docs: https://docs.digitalocean.com/products/app-platform/
- Status: https://status.digitalocean.com/


