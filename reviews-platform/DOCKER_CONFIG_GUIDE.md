# 🐳 CONFIGURAÇÃO COMPLETA DO DOCKER - Reviews Platform

## 🚀 **GUIA PASSO A PASSO**

### **📋 PRÉ-REQUISITOS:**
- ✅ Docker Desktop instalado
- ✅ Git instalado
- ✅ Projeto clonado do GitHub

---

## **1. 🔍 VERIFICAR INSTALAÇÃO DO DOCKER**

### **A. Verificar se Docker está instalado:**
```bash
docker --version
docker-compose --version
```

### **B. Verificar se Docker Desktop está rodando:**
- Abra o Docker Desktop
- Verifique se está com status "Running"
- Se não estiver, clique em "Start"

---

## **2. 📁 PREPARAR O PROJETO**

### **A. Navegar para o diretório:**
```bash
cd C:\Users\IAGO VILELA\Documents\PROJETOS\reviews-platform
```

### **B. Verificar arquivos Docker:**
```bash
# Verificar se existem os arquivos necessários
dir docker-compose.yml
dir Dockerfile
dir start-docker.bat
```

---

## **3. 🔧 CONFIGURAR AMBIENTE**

### **A. Usar configuração Docker:**
```bash
# Executar script para configurar Docker
.\switch-to-docker.bat
```

### **B. Ou configurar manualmente:**
```bash
# Criar arquivo .env para Docker
copy .env .env.backup
```

---

## **4. 🐳 INICIAR DOCKER**

### **A. Método Automático (Recomendado):**
```bash
# Executar script de inicialização
.\start-docker.bat
```

### **B. Método Manual:**
```bash
# Iniciar containers
docker-compose up -d

# Verificar status
docker-compose ps

# Ver logs
docker-compose logs -f app
```

---

## **5. ✅ VERIFICAR FUNCIONAMENTO**

### **A. Verificar containers:**
```bash
docker-compose ps
```

**Resultado esperado:**
```
NAME                IMAGE               STATUS
reviews-app         reviews-platform   Up
reviews-mysql       mysql:8.0          Up
reviews-redis       redis:7-alpine     Up
```

### **B. Testar aplicação:**
- Abrir navegador: http://localhost:8000
- Deve carregar a página de login

### **C. Testar banco de dados:**
```bash
# Conectar ao MySQL
docker-compose exec mysql mysql -u reviews_user -p reviews_platform
```

---

## **6. 🔧 COMANDOS ÚTEIS**

### **A. Gerenciamento de Containers:**
```bash
# Iniciar
docker-compose up -d

# Parar
docker-compose down

# Rebuild (após mudanças)
docker-compose up --build

# Ver status
docker-compose ps

# Ver logs
docker-compose logs -f app
```

### **B. Comandos Laravel:**
```bash
# Executar migrations
docker-compose exec app php artisan migrate

# Executar seeders
docker-compose exec app php artisan db:seed

# Limpar cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
```

### **C. Acesso aos Containers:**
```bash
# Acessar aplicação Laravel
docker-compose exec app bash

# Acessar MySQL
docker-compose exec mysql mysql -u reviews_user -p reviews_platform

# Acessar Redis
docker-compose exec redis redis-cli
```

---

## **7. 🚨 SOLUÇÃO DE PROBLEMAS**

### **A. Erro: "Port already in use"**
```bash
# Verificar portas em uso
netstat -an | findstr :8000
netstat -an | findstr :3306

# Parar processo na porta 8000
taskkill /PID [PID_NUMBER] /F
```

### **B. Erro: "Connection refused"**
```bash
# Verificar se containers estão rodando
docker-compose ps

# Reiniciar containers
docker-compose down
docker-compose up -d
```

### **C. Erro: "Permission denied"**
```bash
# Corrigir permissões
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

---

## **8. 📊 MONITORAMENTO**

### **A. Ver uso de recursos:**
```bash
docker stats
```

### **B. Ver logs em tempo real:**
```bash
docker-compose logs -f app
docker-compose logs -f mysql
```

### **C. Verificar status da aplicação:**
```bash
docker-compose exec app php artisan about
```

---

## **9. 🔄 WORKFLOW DE DESENVOLVIMENTO**

### **A. Desenvolvimento Diário:**
```bash
# 1. Antes de começar
git pull origin main

# 2. Trabalhar no código
# ... fazer alterações ...

# 3. Testar localmente
# Aplicação já está rodando em http://localhost:8000

# 4. Commit e push
git add .
git commit -m "feat: nova funcionalidade"
git push origin main
```

### **B. Sincronização com Parceiro:**
```bash
# Parceiro faz:
git pull origin main
# Aplicação atualiza automaticamente (hot reload)
```

---

## **10. 🎯 CHECKLIST DE CONFIGURAÇÃO**

### **Antes de Começar:**
- [ ] Docker Desktop instalado e rodando
- [ ] Projeto clonado do GitHub
- [ ] Arquivos Docker presentes (docker-compose.yml, Dockerfile)
- [ ] Scripts de inicialização presentes (start-docker.bat)

### **Após Configuração:**
- [ ] Containers rodando (docker-compose ps)
- [ ] Aplicação acessível em http://localhost:8000
- [ ] Banco MySQL funcionando
- [ ] Logs sem erros críticos

### **Para Desenvolvimento:**
- [ ] Hot reload funcionando
- [ ] Banco persistindo dados
- [ ] Comandos Laravel funcionando
- [ ] Acesso aos containers funcionando

---

## **11. 🆘 SUPORTE**

### **Se algo não funcionar:**
1. **Verificar Docker Desktop:** Está rodando?
2. **Verificar containers:** `docker-compose ps`
3. **Verificar logs:** `docker-compose logs`
4. **Reset completo:** `docker-compose down -v && docker-compose up --build`

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

**🎉 Com essa configuração, você terá um ambiente Docker completo e funcional!**
