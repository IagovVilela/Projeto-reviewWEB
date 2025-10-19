# 🔧 SOLUÇÃO DE PROBLEMAS - Docker Reviews Platform

## 🚨 **PROBLEMAS COMUNS E SOLUÇÕES**

### **1. ❌ Erro: "Unsupported cipher or incorrect key length"**

#### **Problema:**
```
Unsupported cipher or incorrect key length. Supported ciphers are: aes-128-cbc, aes-256-cbc, aes-128-gcm, aes-256-gcm.
```

#### **Causa:**
- Chave da aplicação Laravel não configurada ou inválida
- `APP_KEY` vazia ou incorreta no arquivo `.env`

#### **Solução:**
```bash
# Opção 1: Script automático
start-docker.bat

# Opção 2: Manual
php artisan key:generate --force
php artisan config:clear
```

#### **Verificação:**
```bash
# Verificar se a chave foi gerada
php artisan config:show app.key
```

---

### **2. ❌ Erro: "Connection refused" no MySQL**

#### **Problema:**
```
SQLSTATE[HY000] [2002] Connection refused
```

#### **Causa:**
- Container MySQL não iniciado
- Configuração de conexão incorreta

#### **Solução:**
```bash
# Verificar status dos containers
docker-compose ps

# Reiniciar containers
docker-compose down
docker-compose up -d

# Verificar logs do MySQL
docker-compose logs mysql
```

#### **Verificação:**
```bash
# Testar conexão MySQL
docker-compose exec mysql mysql -u reviews_user -p reviews_platform
```

---

### **3. ❌ Erro: "Port already in use"**

#### **Problema:**
```
Error starting userland proxy: listen tcp4 0.0.0.0:8000: bind: address already in use
```

#### **Causa:**
- Porta 8000 já está sendo usada por outro processo
- Servidor Laravel já rodando localmente

#### **Solução:**
```bash
# Opção 1: Parar processo na porta 8000
netstat -ano | findstr :8000
taskkill /PID [PID_NUMBER] /F

# Opção 2: Usar porta diferente
# Editar docker-compose.yml:
# ports:
#   - "8001:8000"  # Usar porta 8001
```

#### **Verificação:**
```bash
# Verificar portas em uso
netstat -an | findstr :8000
netstat -an | findstr :3306
```

---

### **4. ❌ Erro: "Permission denied" no Storage**

#### **Problema:**
```
Permission denied: /var/www/html/storage/logs/laravel.log
```

#### **Causa:**
- Permissões incorretas no diretório storage
- Problema de usuário no container

#### **Solução:**
```bash
# Corrigir permissões
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage

# Ou rebuild completo
docker-compose down
docker-compose up --build
```

#### **Verificação:**
```bash
# Verificar permissões
docker-compose exec app ls -la /var/www/html/storage
```

---

### **5. ❌ Erro: "Class not found"**

#### **Problema:**
```
Class 'App\Http\Controllers\Controller' not found
```

#### **Causa:**
- Autoloader não atualizado
- Dependências não instaladas

#### **Solução:**
```bash
# Atualizar autoloader
docker-compose exec app composer dump-autoload

# Reinstalar dependências
docker-compose exec app composer install --no-dev --optimize-autoloader

# Limpar cache
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
```

#### **Verificação:**
```bash
# Verificar dependências
docker-compose exec app composer show
```

---

### **6. ❌ Erro: "Migration failed"**

#### **Problema:**
```
SQLSTATE[42S01]: Base table or view already exists
```

#### **Causa:**
- Tabelas já existem no banco
- Migrations executadas anteriormente

#### **Solução:**
```bash
# Opção 1: Reset completo do banco
docker-compose down -v
docker-compose up -d

# Opção 2: Rollback e re-executar
docker-compose exec app php artisan migrate:rollback
docker-compose exec app php artisan migrate

# Opção 3: Fresh (apaga e recria)
docker-compose exec app php artisan migrate:fresh --seed
```

#### **Verificação:**
```bash
# Verificar status das migrations
docker-compose exec app php artisan migrate:status
```

---

## 🔍 **COMANDOS DE DIAGNÓSTICO**

### **A. Verificar Status Geral:**
```bash
# Status dos containers
docker-compose ps

# Uso de recursos
docker stats

# Logs gerais
docker-compose logs
```

### **B. Verificar Aplicação:**
```bash
# Status da aplicação
docker-compose exec app php artisan about

# Configuração atual
docker-compose exec app php artisan config:show

# Rotas disponíveis
docker-compose exec app php artisan route:list
```

### **C. Verificar Banco de Dados:**
```bash
# Conectar ao MySQL
docker-compose exec mysql mysql -u reviews_user -p reviews_platform

# Verificar tabelas
docker-compose exec mysql mysql -u reviews_user -p reviews_platform -e "SHOW TABLES;"

# Verificar conexão Laravel
docker-compose exec app php artisan tinker
# DB::connection()->getPdo();
```

---

## 🚀 **RESET COMPLETO**

### **Se nada funcionar:**
```bash
# 1. Parar tudo
docker-compose down -v

# 2. Remover imagens
docker rmi reviews-platform-app

# 3. Limpar sistema Docker
docker system prune -f

# 4. Rebuild completo
docker-compose up --build -d

# 5. Verificar logs
docker-compose logs -f app
```

---

## 📋 **CHECKLIST DE VERIFICAÇÃO**

### **Antes de Reportar Problema:**
- [ ] Docker Desktop está rodando?
- [ ] Containers estão ativos? (`docker-compose ps`)
- [ ] Portas 8000 e 3306 estão livres?
- [ ] Arquivo `.env` existe e tem `APP_KEY`?
- [ ] Logs mostram algum erro específico?
- [ ] Tentou rebuild completo?

### **Informações para Debug:**
```bash
# Coletar informações do sistema
docker --version
docker-compose --version
docker-compose ps
docker-compose logs app
docker-compose logs mysql
```

---

## 🆘 **SUPORTE**

### **Se o problema persistir:**
1. **Coletar logs:** `docker-compose logs > logs.txt`
2. **Screenshot do erro**
3. **Comandos executados**
4. **Versão do Docker:** `docker --version`

### **Comandos de Emergência:**
```bash
# Reset total
docker-compose down -v
docker system prune -f
docker-compose up --build -d

# Acesso direto ao container
docker-compose exec app bash
```

---

**🎯 Com essas soluções, a maioria dos problemas do Docker será resolvida!**
