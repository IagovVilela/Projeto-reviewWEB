# 🌐 Guia de Hospedagem - Reviews Platform

## 📋 Índice
1. [Opções Gratuitas](#opções-gratuitas)
2. [Opções Pagas (Econômicas)](#opções-pagas-econômicas)
3. [Opções Profissionais](#opções-profissionais)
4. [Comparativo](#comparativo)
5. [Guia de Deploy](#guia-de-deploy)

---

## 🆓 Opções Gratuitas

### 1. **Railway** ⭐ RECOMENDADO
**Preço:** Plano gratuito generoso + créditos mensais
**Ideal para:** Testes, projetos pequenos/médios

**Vantagens:**
- ✅ Deploy automático via GitHub
- ✅ PostgreSQL/MySQL incluído
- ✅ SSL automático
- ✅ Suporte a Laravel nativo
- ✅ 500 horas/mês grátis ($5 créditos)
- ✅ Domínio personalizado grátis

**Desvantagens:**
- ⚠️ Aplicação dorme após inatividade (primeira requisição é lenta)
- ⚠️ Limite de recursos no plano gratuito

**Como usar:**
```bash
# 1. Instale o Railway CLI
npm i -g @railway/cli

# 2. Login
railway login

# 3. Deploy
railway init
railway up
```

**Link:** https://railway.app

---

### 2. **Render**
**Preço:** Plano gratuito disponível
**Ideal para:** Projetos pequenos

**Vantagens:**
- ✅ Deploy automático via GitHub
- ✅ PostgreSQL grátis (90 dias, depois $7/mês)
- ✅ SSL automático
- ✅ Fácil configuração

**Desvantagens:**
- ⚠️ Aplicação dorme após 15min de inatividade
- ⚠️ Banco de dados pago após trial

**Link:** https://render.com

---

### 3. **Fly.io**
**Preço:** Plano gratuito com limites
**Ideal para:** Deploy rápido e escalável

**Vantagens:**
- ✅ Múltiplas regiões
- ✅ SSL automático
- ✅ Deploy rápido
- ✅ Suporte a Docker

**Desvantagens:**
- ⚠️ Curva de aprendizado média
- ⚠️ Limites no plano gratuito

**Link:** https://fly.io

---

### 4. **Heroku** (Limitações)
**Preço:** Não oferece mais plano gratuito
**Ideal para:** Não recomendado (removido plano gratuito)

**Status:** Removeram o plano gratuito em 2022

---

## 💰 Opções Pagas (Econômicas)

### 1. **DigitalOcean App Platform** ⭐ MELHOR CUSTO-BENEFÍCIO
**Preço:** A partir de $5/mês
**Ideal para:** Produção pequena/média

**Vantagens:**
- ✅ Preço competitivo
- ✅ Deploy automático
- ✅ Banco de dados gerenciado ($15/mês)
- ✅ SSL automático
- ✅ Escalável
- ✅ Documentação excelente

**Desvantagens:**
- ⚠️ Banco de dados custa extra

**Link:** https://www.digitalocean.com/products/app-platform

**Configuração Recomendada:**
- App: Basic ($5/mês) - 512MB RAM
- Database: Basic ($15/mês) - 1GB SSD
- **Total: ~$20/mês**

---

### 2. **Linode / Akamai**
**Preço:** A partir de $5/mês
**Ideal para:** VPS gerenciado

**Vantagens:**
- ✅ VPS completo
- ✅ Controle total
- ✅ Preço baixo
- ✅ Bom suporte

**Desvantagens:**
- ⚠️ Requer conhecimento técnico
- ⚠️ Gerenciamento manual

**Link:** https://www.linode.com

---

### 3. **Vultr**
**Preço:** A partir de $2.50/mês
**Ideal para:** VPS econômico

**Vantagens:**
- ✅ Preço muito baixo
- ✅ Múltiplas localizações
- ✅ Performance boa

**Desvantagens:**
- ⚠️ Requer configuração manual
- ⚠️ Sem gerenciamento automático

**Link:** https://www.vultr.com

---

### 4. **Hostinger**
**Preço:** A partir de $2.99/mês
**Ideal para:** Hospedagem compartilhada (requer adaptações)

**Vantagens:**
- ✅ Preço muito baixo
- ✅ Painel cPanel
- ✅ Suporte em português

**Desvantagens:**
- ⚠️ Hosting compartilhado pode ter limitações
- ⚠️ Requer configuração especial para Laravel
- ⚠️ Performance limitada

**Link:** https://www.hostinger.com.br

---

## 🏢 Opções Profissionais

### 1. **Laravel Forge** ⭐ ESPECIALIZADO EM LARAVEL
**Preço:** $12/mês + servidor (DigitalOcean $5/mês)
**Ideal para:** Desenvolvedores Laravel

**Vantagens:**
- ✅ Feito especificamente para Laravel
- ✅ Deploy automático via Git
- ✅ SSL automático (Let's Encrypt)
- ✅ Gerenciamento de servidores
- ✅ Backups automáticos
- ✅ Fila de jobs gerenciada

**Desvantagens:**
- ⚠️ Custo total: ~$17/mês mínimo
- ⚠️ Requer servidor separado

**Link:** https://forge.laravel.com

---

### 2. **AWS (Amazon Web Services)**
**Preço:** Pay-as-you-go (complexo)
**Ideal para:** Escala empresarial

**Vantagens:**
- ✅ Infraestrutura robusta
- ✅ Escalabilidade ilimitada
- ✅ Muitos serviços integrados

**Desvantagens:**
- ⚠️ Configuração complexa
- ⚠️ Custos podem escalar rápido
- ⚠️ Curva de aprendizado alta

**Opções AWS:**
- **Lightsail:** $3.50/mês (mais simples)
- **EC2:** Pay-as-you-go
- **Elastic Beanstalk:** Gerenciado

---

### 3. **Google Cloud Platform (GCP)**
**Preço:** $300 créditos grátis por 90 dias
**Ideal para:** Testes e projetos grandes

**Vantagens:**
- ✅ Créditos gratuitos generosos
- ✅ Infraestrutura poderosa
- ✅ Muitos serviços

**Desvantagens:**
- ⚠️ Configuração complexa
- ⚠️ Custos podem escalar

---

### 4. **Microsoft Azure**
**Preço:** $200 créditos grátis por 30 dias
**Ideal para:** Integração com Microsoft

**Vantagens:**
- ✅ Créditos grátis
- ✅ Integração com Microsoft

**Desvantagens:**
- ⚠️ Configuração complexa

---

## 📊 Comparativo Rápido

| Plataforma | Preço | Facilidade | Ideal Para |
|------------|-------|------------|------------|
| **Railway** | Grátis/$5 | ⭐⭐⭐⭐⭐ | Testes/Projetos pequenos |
| **DigitalOcean** | $5-$20 | ⭐⭐⭐⭐ | Produção pequena/média |
| **Render** | Grátis/$7 | ⭐⭐⭐⭐ | Projetos pequenos |
| **Laravel Forge** | $12+$5 | ⭐⭐⭐⭐⭐ | Desenvolvedores Laravel |
| **Vultr** | $2.50+ | ⭐⭐⭐ | VPS econômico |
| **Hostinger** | $2.99+ | ⭐⭐⭐ | Hospedagem compartilhada |

---

## 🚀 Recomendações por Caso de Uso

### Para Começar (Testes/Protótipo)
1. **Railway** - Melhor opção gratuita
2. **Render** - Alternativa gratuita

### Para Produção Pequena (até 1000 visitas/mês)
1. **DigitalOcean App Platform** ($20/mês) - Melhor custo-benefício
2. **Laravel Forge + Vultr** ($17/mês) - Mais controle

### Para Produção Média (1000-10000 visitas/mês)
1. **Laravel Forge + DigitalOcean** ($17-$25/mês)
2. **DigitalOcean App Platform** (escalável)

### Para Produção Grande (10000+ visitas/mês)
1. **AWS/GCP** - Infraestrutura escalável
2. **Laravel Forge + Servidor dedicado**

---

## 📝 Guia de Deploy - DigitalOcean (Recomendado)

### Passo 1: Preparar o Código

```bash
# No seu projeto
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Passo 2: Configurar .env

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://seusite.com

DB_CONNECTION=mysql
DB_HOST=seu-db-host
DB_DATABASE=seu-db
DB_USERNAME=seu-user
DB_PASSWORD=sua-senha

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-app
```

### Passo 3: Deploy no DigitalOcean

1. Acesse: https://cloud.digitalocean.com
2. Crie nova App
3. Conecte seu repositório GitHub
4. Configure:
   - **Build Command:** `composer install --no-dev --optimize-autoloader && php artisan config:cache`
   - **Run Command:** `php artisan serve --host=0.0.0.0 --port=$PORT`
5. Adicione banco de dados MySQL
6. Configure variáveis de ambiente
7. Deploy!

---

## 📝 Guia de Deploy - Railway (Gratuito)

### Passo 1: Preparar Projeto

Crie `railway.json`:
```json
{
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

### Passo 2: Deploy

1. Acesse: https://railway.app
2. Conecte GitHub
3. Selecione repositório
4. Railway detecta Laravel automaticamente
5. Adicione banco de dados PostgreSQL
6. Configure variáveis de ambiente
7. Deploy automático!

---

## 🔧 Checklist Antes do Deploy

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` configurado
- [ ] Banco de dados configurado
- [ ] Storage link criado (`php artisan storage:link`)
- [ ] Migrations rodadas (`php artisan migrate`)
- [ ] Config cache (`php artisan config:cache`)
- [ ] Route cache (`php artisan route:cache`)
- [ ] View cache (`php artisan view:cache`)
- [ ] E-mail SMTP configurado
- [ ] Cron configurado (para schedule)
- [ ] Queue worker rodando (se usar filas)

---

## 💡 Dicas Importantes

### 1. Banco de Dados
- Use MySQL ou PostgreSQL
- Evite SQLite em produção
- Configure backups automáticos

### 2. Storage
- Use armazenamento cloud (S3, DigitalOcean Spaces) para arquivos
- Ou configure storage link corretamente

### 3. Filas e Schedule
- Configure worker para processar filas
- Configure cron para schedule:
  ```
  * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
  ```

### 4. SSL/HTTPS
- Use Let's Encrypt (gratuito)
- Maioria das plataformas configura automaticamente

### 5. Domínio
- Configure DNS apontando para servidor
- Aguarde propagação (até 48h)

---

## 🆘 Suporte

Para cada plataforma:
- **Railway:** Docs em railway.app/docs
- **DigitalOcean:** Docs em docs.digitalocean.com
- **Laravel Forge:** Docs em forge.laravel.com/docs

---

## ✅ Recomendação Final

**Para começar:** Railway (gratuito) ou Render (gratuito)

**Para produção:** DigitalOcean App Platform ($20/mês) ou Laravel Forge + Vultr ($17/mês)

**Melhor custo-benefício:** DigitalOcean App Platform

---

**Última atualização:** Novembro 2024


