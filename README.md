# 🌟 Reviews Platform

> Sistema completo de gestão de avaliações com redirecionamento inteligente e feedback privado

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)](https://mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.0-38B2AC?logo=tailwind-css)](https://tailwindcss.com)
[![Status](https://img.shields.io/badge/Status-100%25%20Complete-success)](docs/project/status.md)

---

## 🎯 O Que É?

**Reviews Platform** é uma plataforma web inteligente que permite empresas coletarem avaliações de clientes e direcionarem o feedback de forma estratégica:

- ✨ **Avaliações Positivas** → Redirecionadas para Google Maps
- 💬 **Avaliações Negativas** → Feedback privado para melhorias internas

---

## ⚡ Quick Start

```bash
# 1. Entre na pasta do projeto
cd Projeto-reviewWEB/reviews-platform

# 2. Instale as dependências
composer install

# 3. Configure o ambiente
cp .env.example .env
php artisan key:generate

# 4. Configure o banco de dados no .env
# DB_DATABASE=reviews_platform
# DB_USERNAME=root
# DB_PASSWORD=sua_senha

# 5. Execute as migrations
php artisan migrate
php artisan db:seed

# 6. Configure o storage
php artisan storage:link

# 7. Inicie o servidor
php artisan serve
```

Acesse: **http://localhost:8000**

**Login padrão:**
- Email: `admin@reviewsplatform.com`
- Senha: `password123`

📖 **Guia completo:** [Quick Start Guide](docs/installation/quick-start.md)

---

## ✨ Funcionalidades

### 🎯 Core Features
- ✅ **Gestão de Empresas** - CRUD completo com upload de logo e fundo
- ✅ **Páginas Públicas** - URL customizada por empresa
- ✅ **Coleta de Avaliações** - Sistema de estrelas + WhatsApp obrigatório
- ✅ **Redirecionamento Inteligente** - Baseado na nota (positiva/negativa)
- ✅ **Notificações por Email** - Alertas automáticos ao proprietário
- ✅ **Dashboard Administrativo** - Estatísticas e gráficos em tempo real
- ✅ **Exportação CSV** - Download de contatos e dados

### 🎁 Extras Implementados
- 🌍 **Tradução PT/EN** - Interface em dois idiomas
- 🌙 **Dark Mode** - Modo escuro para reduzir fadiga visual
- 🚨 **Badge de Negativas** - Alerta visual de novas avaliações negativas
- 🔒 **Proteção de Dados** - Impede deleção de empresas com avaliações
- 📊 **Gráficos Interativos** - Chart.js com animações
- ✏️ **Formatação Automática** - WhatsApp e datas formatados

---

## 📸 Screenshots

### Dashboard Administrativo
![Dashboard](docs/assets/dashboard-preview.png)

### Página Pública de Avaliação
![Public Page](docs/assets/public-page-preview.png)

### Dark Mode
![Dark Mode](docs/assets/dark-mode-preview.png)

---

## 🚀 Como Funciona

### Para Administradores
1. **Criar Empresa** no painel administrativo
2. **Configurar** logo, fundo, URL e nota positiva
3. **Compartilhar** link público com clientes
4. **Monitorar** avaliações no dashboard
5. **Exportar** contatos quando necessário

### Para Clientes (Avaliadores)
1. **Acessar** link público da empresa
2. **Informar** WhatsApp
3. **Dar** nota de 1 a 5 estrelas
4. **Se positiva** (≥ nota configurada):
   - Escrever comentário opcional
   - Redirecionado para Google Maps
5. **Se negativa** (< nota configurada):
   - Dar feedback privado
   - Escolher forma de contato
   - Proprietário recebe email

---

## 🛠️ Stack Tecnológica

### Backend
- **Framework:** Laravel 10.x
- **PHP:** 8.1+
- **Database:** MySQL 8.0

### Frontend
- **Template:** Blade
- **CSS:** Tailwind CSS 3.0
- **JavaScript:** Vanilla JS + Chart.js
- **Icons:** Font Awesome 6.4

### Features
- **Mail:** SMTP (configurável)
- **Storage:** Laravel File Storage
- **Translation:** Sistema customizado PT/EN
- **Charts:** Chart.js 4.0

---

## 📚 Documentação

### 🎯 Início Rápido
- 📖 [Quick Start Guide](docs/installation/quick-start.md) - Comece em 5 minutos
- 🔧 [Guia de Instalação Completo](docs/installation/installation-guide.md)
- 🆘 [Troubleshooting](docs/troubleshooting/README.md)

### 🎨 Funcionalidades
- 🌍 [Sistema de Tradução](docs/features/translation-system.md)
- 🌙 [Dark Mode](docs/features/dark-mode.md)
- 📧 [Sistema de Email](docs/features/email-notifications.md)
- 🚨 [Badge de Negativas](docs/features/negative-reviews-badge.md)

### 💻 Desenvolvimento
- 🏗️ [Arquitetura do Sistema](docs/development/architecture.md)
- 📝 [Guia de Desenvolvimento](docs/development/development-guide.md)
- 🎨 [Padrões de Design](docs/development/design-patterns.md)

### 📋 Projeto
- 📄 [Briefing Completo](docs/project/briefing.md)
- ✅ [Status do Projeto](docs/project/status.md)
- 🗺️ [Roadmap](docs/project/roadmap.md)

📖 **Documentação completa:** [docs/README.md](docs/README.md)

---

## 📊 Status do Projeto

| Categoria | Status | Progresso |
|-----------|--------|-----------|
| Backend | ✅ Completo | 100% |
| Frontend | ✅ Completo | 100% |
| Database | ✅ Completo | 100% |
| Features Core | ✅ Completo | 100% |
| Features Extras | ✅ Completo | 100% |
| Documentação | ✅ Completo | 100% |
| **TOTAL** | **✅ Pronto** | **100%** |

---

## 🔧 Configuração

### Requisitos
- PHP 8.1 ou superior
- Composer
- MySQL 8.0 ou superior
- Node.js e npm (opcional)

### Variáveis de Ambiente

```env
# Aplicação
APP_NAME="Reviews Platform"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Banco de Dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reviews_platform
DB_USERNAME=root
DB_PASSWORD=

# Email (Opcional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@reviewsplatform.com
```

---

## 🆘 Problemas Comuns

### Erro de Conexão com Banco
```bash
# Verificar se MySQL está rodando
mysql -u root -p

# Criar banco manualmente
CREATE DATABASE reviews_platform;
```

### Erro de Permissão
```bash
# Windows
icacls storage /grant "Everyone:(OI)(CI)F" /T

# Linux/Mac
chmod -R 775 storage bootstrap/cache
```

### Página em Branco
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

📖 **Mais soluções:** [Troubleshooting Completo](docs/troubleshooting/README.md)

---

## 🗺️ Roadmap Futuro

### Sugestões para Próximas Versões
- [ ] Autenticação via OAuth (Google, Facebook)
- [ ] App mobile (React Native)
- [ ] Integração com WhatsApp Business API
- [ ] Dashboard de analytics avançado
- [ ] Sistema de templates de email customizáveis
- [ ] Multi-idioma (adicionar ES, FR)
- [ ] API RESTful para integrações
- [ ] Sistema de notificações push
- [ ] Relatórios em PDF
- [ ] Integração com CRM

---

## 📝 Licença

Este projeto é propriedade privada. Todos os direitos reservados.

---

## 👨‍💻 Desenvolvedor

**Iago Vilela**

- 📧 Email: contato@exemplo.com
- 💼 LinkedIn: [linkedin.com/in/seu-perfil](https://linkedin.com)
- 🐱 GitHub: [github.com/seu-usuario](https://github.com)

---

## 🎉 Agradecimentos

Obrigado por usar o **Reviews Platform**!

### Tecnologias Utilizadas
- [Laravel](https://laravel.com) - Framework PHP
- [Tailwind CSS](https://tailwindcss.com) - Framework CSS
- [Chart.js](https://www.chartjs.org) - Biblioteca de gráficos
- [Font Awesome](https://fontawesome.com) - Ícones

---

## 📞 Suporte

- 📖 [Documentação](docs/README.md)
- 🐛 [Troubleshooting](docs/troubleshooting/README.md)
- ❓ [FAQ](docs/faq.md)

---

<div align="center">

**[Documentação](docs/README.md)** • 
**[Quick Start](docs/installation/quick-start.md)** • 
**[Briefing](docs/project/briefing.md)** • 
**[Status](docs/project/status.md)**

---

Feito com ❤️ por Iago Vilela

**Versão 2.2.0** | Outubro 2025

</div>

