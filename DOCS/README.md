# 🚀 Plataforma de Reviews - Guia Completo de Instalação

## 📋 Visão Geral

Esta é uma aplicação web completa para gerenciamento de reviews de empresas, desenvolvida com:
- **Backend:** Laravel 9 (PHP 8.0+)
- **Frontend:** React 19 + Vite + Tailwind CSS
- **Banco de Dados:** MySQL

## 🎯 Início Rápido

### Para Usuários Windows (Recomendado)
1. **Baixe o projeto** para `C:\Users\[SEU_USUARIO]\Documents\PROJETOS`
2. **Execute:** `INICIAR_APLICACAO.bat` (clique duplo)
3. **Acesse:** 
   - Frontend: http://localhost:5173
   - Backend: http://localhost:8000

### Para Outros Sistemas ou Instalação Manual
Siga o [Guia de Instalação Completa](#-instalação-completa) abaixo.

## 📁 Estrutura do Projeto

```
PROJETOS/
├── reviews-platform/          # Projeto Laravel principal
│   ├── app/                   # Lógica da aplicação
│   ├── database/             # Migrações e seeders
│   ├── frontend/             # Aplicação React
│   ├── resources/            # Views e assets
│   ├── routes/               # Rotas da aplicação
│   └── vendor/               # Dependências PHP
├── INICIAR_APLICACAO.bat     # Script de inicialização automática
└── DOCUMENTACAO/             # Documentação completa
```

## ⚡ Pré-requisitos

### Obrigatórios
- **PHP 8.0+** - [Download](https://www.php.net/downloads.php)
- **Composer** - [Download](https://getcomposer.org/download/)
- **Node.js 18+** - [Download](https://nodejs.org/)
- **MySQL 8.0+** - [Download](https://dev.mysql.com/downloads/)

### Opcionais (Recomendados)
- **Git** - [Download](https://git-scm.com/downloads)
- **VS Code** - [Download](https://code.visualstudio.com/)

## 🔧 Instalação Completa

### 1. Preparar o Ambiente

#### Windows
```bash
# Verificar instalações
php --version
composer --version
node --version
npm --version
mysql --version
```

#### Linux/Mac
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install php8.0 php8.0-mysql php8.0-mbstring php8.0-xml composer nodejs npm mysql-server

# macOS (com Homebrew)
brew install php composer node mysql
```

### 2. Configurar o Banco de Dados

#### Criar Banco de Dados
```sql
-- Conectar ao MySQL
mysql -u root -p

-- Criar banco de dados
CREATE DATABASE reviews_platform CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Criar usuário (opcional)
CREATE USER 'reviews_user'@'localhost' IDENTIFIED BY 'sua_senha';
GRANT ALL PRIVILEGES ON reviews_platform.* TO 'reviews_user'@'localhost';
FLUSH PRIVILEGES;
```

### 3. Configurar a Aplicação

#### Navegar para o Projeto
```bash
cd reviews-platform
```

#### Instalar Dependências PHP
```bash
composer install
```

#### Configurar Arquivo de Ambiente
```bash
# Copiar arquivo de exemplo
cp .env.example .env

# Editar configurações do banco
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=reviews_platform
# DB_USERNAME=root
# DB_PASSWORD=sua_senha_mysql
```

#### Gerar Chave da Aplicação
```bash
php artisan key:generate
```

#### Executar Migrações
```bash
php artisan migrate
php artisan db:seed
```

### 4. Configurar Frontend

#### Instalar Dependências Node.js
```bash
cd frontend
npm install
cd ..
```

### 5. Iniciar Aplicação

#### Opção 1: Script Automático (Windows)
```bash
# Execute o arquivo .bat
INICIAR_APLICACAO.bat
```

#### Opção 2: Manual
```bash
# Terminal 1 - Backend Laravel
php artisan serve

# Terminal 2 - Frontend React
cd frontend
npm run dev
```

## 🌐 Acessar a Aplicação

- **Frontend React:** http://localhost:5173
- **Backend Laravel:** http://localhost:8000
- **Admin Panel:** http://localhost:8000/admin

## 👤 Usuário Administrador Padrão

Após executar os seeders, você terá acesso com:
- **Email:** admin@example.com
- **Senha:** password

## 🛠️ Comandos Úteis

### Laravel
```bash
# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Executar migrações
php artisan migrate

# Executar seeders
php artisan db:seed

# Criar usuário admin
php artisan make:seeder AdminUserSeeder
```

### React
```bash
# Instalar dependências
npm install

# Modo desenvolvimento
npm run dev

# Build para produção
npm run build

# Preview build
npm run preview
```

## 🔍 Troubleshooting

### Problemas Comuns

#### 1. Erro de Conexão com Banco
```bash
# Verificar se MySQL está rodando
# Windows
net start mysql

# Linux
sudo systemctl start mysql

# Verificar configurações no .env
```

#### 2. Erro de Permissões
```bash
# Linux/Mac
sudo chown -R $USER:$USER storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

#### 3. Porta já em Uso
```bash
# Laravel em porta diferente
php artisan serve --port=8001

# React em porta diferente
npm run dev -- --port 5174
```

#### 4. Dependências não Instaladas
```bash
# Reinstalar dependências PHP
rm -rf vendor
composer install

# Reinstalar dependências Node.js
rm -rf node_modules package-lock.json
npm install
```

## 📚 Documentação Adicional

- [Guia de Troubleshooting Detalhado](./DOCUMENTACAO/TROUBLESHOOTING.md)
- [Configuração do MySQL](./DOCUMENTACAO/MYSQL_SETUP.md)
- [Deploy em Produção](./DOCUMENTACAO/DEPLOY.md)
- [Desenvolvimento](./DOCUMENTACAO/DESENVOLVIMENTO.md)

## 🤝 Suporte

Se encontrar problemas:

1. **Verifique** a seção de Troubleshooting
2. **Consulte** os logs em `storage/logs/laravel.log`
3. **Execute** o diagnóstico: `php artisan about`
4. **Abra uma issue** no repositório do projeto

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

---

**Desenvolvido com ❤️ para facilitar o gerenciamento de reviews**