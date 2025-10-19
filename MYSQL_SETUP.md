# 🗄️ Guia de Conexão MySQL - Plataforma de Avaliações

## 📋 Pré-requisitos
- MySQL 8.0+ instalado
- PHP 8.2+ com extensão PDO MySQL
- Composer instalado

## 🔧 Configuração Passo a Passo

### 1. Verificar Instalação do MySQL

**Windows:**
```bash
# Verificar se MySQL está rodando
mysql --version

# Ou verificar serviço
services.msc
# Procurar por "MySQL80" ou similar
```

**Linux/Mac:**
```bash
# Verificar status
sudo systemctl status mysql
# ou
brew services list | grep mysql
```

### 2. Criar Banco de Dados

**Opção A: Via Linha de Comando**
```bash
# Conectar ao MySQL
mysql -u root -p

# Criar banco de dados
CREATE DATABASE reviews_platform CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Criar usuário específico (opcional, mas recomendado)
CREATE USER 'reviews_user'@'localhost' IDENTIFIED BY 'senha_segura_123';
GRANT ALL PRIVILEGES ON reviews_platform.* TO 'reviews_user'@'localhost';
FLUSH PRIVILEGES;

# Sair
EXIT;
```

**Opção B: Via phpMyAdmin**
1. Acesse http://localhost/phpmyadmin
2. Clique em "Novo" no menu lateral
3. Nome do banco: `reviews_platform`
4. Collation: `utf8mb4_unicode_ci`
5. Clique em "Criar"

### 3. Configurar Arquivo .env

Edite o arquivo `.env` na raiz do projeto:

```env
# Configurações do Banco de Dados
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=reviews_platform
DB_USERNAME=root
DB_PASSWORD=sua_senha_aqui

# Se criou usuário específico, use:
# DB_USERNAME=reviews_user
# DB_PASSWORD=senha_segura_123
```

### 4. Testar Conexão

**Via Artisan:**
```bash
# Testar conexão
php artisan tinker

# No tinker, execute:
DB::connection()->getPdo();
# Deve retornar: PDO object

# Testar query simples
DB::select('SELECT 1 as test');
# Deve retornar: [{"test": 1}]

# Sair do tinker
exit
```

**Via Comando:**
```bash
# Verificar configuração
php artisan config:show database

# Testar migração
php artisan migrate:status
```

### 5. Executar Migrations

```bash
# Executar todas as migrations
php artisan migrate

# Se der erro, pode tentar:
php artisan migrate:fresh
# (CUIDADO: Isso apaga todos os dados!)

# Verificar se as tabelas foram criadas
php artisan tinker
DB::select('SHOW TABLES');
```

## 🐛 Solução de Problemas Comuns

### Erro: "Access denied for user"
```bash
# Verificar credenciais
mysql -u root -p

# Se não conseguir conectar, resetar senha:
# Windows (como administrador):
net stop mysql
mysqld --skip-grant-tables --console
# Em outro terminal:
mysql -u root
UPDATE mysql.user SET authentication_string=PASSWORD('nova_senha') WHERE User='root';
FLUSH PRIVILEGES;
EXIT;
net start mysql
```

### Erro: "Can't connect to MySQL server"
```bash
# Verificar se MySQL está rodando
# Windows:
net start mysql

# Linux:
sudo systemctl start mysql

# Mac:
brew services start mysql
```

### Erro: "Unknown database"
```bash
# Criar o banco de dados
mysql -u root -p
CREATE DATABASE reviews_platform CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Erro: "PDO extension not found"
```bash
# Instalar extensão PDO MySQL
# Ubuntu/Debian:
sudo apt-get install php-mysql

# CentOS/RHEL:
sudo yum install php-mysql

# Windows: Editar php.ini
# Descomentar: extension=pdo_mysql
```

## 🔍 Verificações Importantes

### 1. Verificar Extensões PHP
```bash
php -m | grep -i pdo
# Deve mostrar: pdo_mysql

php -m | grep -i mysql
# Deve mostrar: mysql, mysqli, pdo_mysql
```

### 2. Verificar Configuração PHP
```bash
php --ini
# Mostra onde está o php.ini

# Verificar configurações MySQL
php -i | grep -i mysql
```

### 3. Testar Conexão Manual
```php
<?php
// test_connection.php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=reviews_platform', 'root', 'sua_senha');
    echo "✅ Conexão bem-sucedida!";
} catch(PDOException $e) {
    echo "❌ Erro: " . $e->getMessage();
}
?>
```

## 📊 Comandos Úteis

### Backup e Restore
```bash
# Backup
mysqldump -u root -p reviews_platform > backup.sql

# Restore
mysql -u root -p reviews_platform < backup.sql
```

### Monitoramento
```bash
# Ver processos MySQL
mysql -u root -p
SHOW PROCESSLIST;

# Ver status
SHOW STATUS;

# Ver variáveis
SHOW VARIABLES LIKE '%timeout%';
```

## 🚀 Configuração para Produção

### Otimizações MySQL
```sql
-- Configurações recomendadas no my.cnf
[mysqld]
innodb_buffer_pool_size = 1G
max_connections = 200
query_cache_size = 64M
query_cache_type = 1
```

### Usuário Dedicado
```sql
-- Criar usuário específico para produção
CREATE USER 'reviews_prod'@'localhost' IDENTIFIED BY 'senha_muito_segura';
GRANT SELECT, INSERT, UPDATE, DELETE ON reviews_platform.* TO 'reviews_prod'@'localhost';
FLUSH PRIVILEGES;
```

## 📝 Checklist de Conexão

- [ ] MySQL instalado e rodando
- [ ] Banco `reviews_platform` criado
- [ ] Usuário configurado (root ou específico)
- [ ] Arquivo `.env` configurado
- [ ] Extensão PDO MySQL ativa
- [ ] Teste de conexão bem-sucedido
- [ ] Migrations executadas
- [ ] Tabelas criadas corretamente

## 🆘 Suporte Rápido

### Comandos de Diagnóstico
```bash
# Verificar status geral
php artisan about

# Verificar configuração de banco
php artisan config:show database

# Verificar migrations
php artisan migrate:status

# Limpar cache se necessário
php artisan config:clear
php artisan cache:clear
```

### Logs Úteis
```bash
# Logs do Laravel
tail -f storage/logs/laravel.log

# Logs do MySQL (Linux)
tail -f /var/log/mysql/error.log

# Logs do MySQL (Windows)
# Geralmente em: C:\ProgramData\MySQL\MySQL Server 8.0\Data\
```

## 📞 Próximos Passos

Após conectar com sucesso:

1. **Executar migrations**: `php artisan migrate`
2. **Criar usuário admin**: `php artisan db:seed --class=AdminUserSeeder`
3. **Testar sistema**: Acessar http://localhost:8000/login
4. **Criar primeira empresa**: Testar fluxo completo

---

**Dica**: Se ainda tiver problemas, compartilhe a mensagem de erro específica que posso ajudar com soluções mais direcionadas! 🚀




