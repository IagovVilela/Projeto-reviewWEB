# 🐳 DOCKER SETUP COMPLETO - Reviews Platform

## 🚀 **CONFIGURAÇÃO PRONTA PARA USO**

### **📋 Arquivos Criados:**
- ✅ `docker-compose.yml` - Configuração dos containers
- ✅ `Dockerfile` - Imagem da aplicação Laravel
- ✅ `.dockerignore` - Otimização do build
- ✅ `.env` - Configuração para Docker
- ✅ `start-docker.bat` - Script de inicialização
- ✅ `stop-docker.bat` - Script de parada

### **🎯 COMO USAR:**

#### **1. Inicialização Rápida:**
```bash
# Opção A: Script automático
start-docker.bat

# Opção B: Comandos manuais
docker-compose up -d
```

#### **2. Verificar Status:**
```bash
docker-compose ps
```

#### **3. Ver Logs:**
```bash
docker-compose logs -f app
```

#### **4. Parar:**
```bash
# Opção A: Script automático
stop-docker.bat

# Opção B: Comandos manuais
docker-compose down
```

### **🌐 URLs de Acesso:**
- **Aplicação:** http://localhost:8000
- **MySQL:** localhost:3306
- **Redis:** localhost:6379

### **👥 DESENVOLVIMENTO EM EQUIPE:**

#### **Para Você:**
```bash
git clone https://github.com/IagovVilela/Projeto-reviewWEB.git
cd Projeto-reviewWEB
start-docker.bat
```

#### **Para Seu Parceiro:**
```bash
git clone https://github.com/IagovVilela/Projeto-reviewWEB.git
cd Projeto-reviewWEB
start-docker.bat
```

### **🔄 WORKFLOW DE DESENVOLVIMENTO:**

#### **1. Sincronização Diária:**
```bash
# Antes de começar:
git pull origin main

# Após fazer alterações:
git add .
git commit -m "feat: nova funcionalidade"
git push origin main
```

#### **2. Sincronização de Banco:**
```bash
# Quando houver mudanças no banco:
docker-compose exec app php artisan migrate

# Para compartilhar dados de teste:
docker-compose exec app php artisan db:seed
```

### **🛠️ COMANDOS ÚTEIS:**

#### **A. Gerenciamento de Containers:**
```bash
# Iniciar
docker-compose up -d

# Parar
docker-compose down

# Rebuild (após mudanças no Dockerfile)
docker-compose up --build

# Ver status
docker-compose ps

# Ver logs
docker-compose logs -f app
docker-compose logs -f mysql
```

#### **B. Acesso aos Containers:**
```bash
# Acessar aplicação Laravel
docker-compose exec app bash

# Acessar MySQL
docker-compose exec mysql mysql -u reviews_user -p reviews_platform

# Acessar Redis
docker-compose exec redis redis-cli
```

#### **C. Comandos Laravel:**
```bash
# Executar migrations
docker-compose exec app php artisan migrate

# Executar seeders
docker-compose exec app php artisan db:seed

# Limpar cache
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear

# Gerar chave da aplicação
docker-compose exec app php artisan key:generate
```

### **🗄️ GERENCIAMENTO DO BANCO:**

#### **A. Backup:**
```bash
# Exportar dados
docker-compose exec mysql mysqldump -u reviews_user -p reviews_platform > backup.sql

# Importar dados
docker-compose exec -T mysql mysql -u reviews_user -p reviews_platform < backup.sql
```

#### **B. Reset do Banco:**
```bash
# Parar containers
docker-compose down

# Remover volumes (CUIDADO: apaga todos os dados!)
docker-compose down -v

# Reiniciar
docker-compose up -d
```

### **🔧 CONFIGURAÇÕES:**

#### **A. Credenciais do Banco:**
- **Host:** mysql
- **Porta:** 3306
- **Database:** reviews_platform
- **Username:** reviews_user
- **Password:** reviews_pass

#### **B. Credenciais Root MySQL:**
- **Username:** root
- **Password:** root

### **📊 MONITORAMENTO:**

#### **A. Recursos:**
```bash
# Ver uso de recursos
docker stats

# Ver informações dos containers
docker-compose exec app php artisan about
```

#### **B. Logs:**
```bash
# Logs da aplicação
docker-compose logs -f app

# Logs do MySQL
docker-compose logs -f mysql

# Logs do Redis
docker-compose logs -f redis
```

### **🚨 SOLUÇÃO DE PROBLEMAS:**

#### **A. Container não inicia:**
```bash
# Ver logs de erro
docker-compose logs app

# Rebuild completo
docker-compose down
docker-compose up --build
```

#### **B. Banco não conecta:**
```bash
# Verificar se MySQL está rodando
docker-compose ps mysql

# Ver logs do MySQL
docker-compose logs mysql

# Testar conexão
docker-compose exec mysql mysql -u reviews_user -p
```

#### **C. Porta ocupada:**
```bash
# Verificar portas em uso
netstat -an | findstr :8000
netstat -an | findstr :3306

# Parar outros serviços ou mudar portas no docker-compose.yml
```

### **🎉 VANTAGENS DO DOCKER:**

✅ **Ambiente Idêntico:** Mesma configuração para ambos
✅ **Banco Compartilhado:** Dados sincronizados automaticamente
✅ **Fácil Setup:** Um comando para iniciar tudo
✅ **Isolamento:** Não interfere com outros projetos
✅ **Portabilidade:** Funciona em qualquer máquina
✅ **Backup Simples:** Volume persistente do MySQL
✅ **Escalabilidade:** Fácil adicionar novos serviços

### **📋 CHECKLIST DE USO:**

- [ ] Docker Desktop instalado
- [ ] Arquivos Docker criados
- [ ] Script start-docker.bat executado
- [ ] Aplicação acessível em http://localhost:8000
- [ ] Banco MySQL funcionando
- [ ] Parceiro consegue usar a mesma configuração

### **🔗 PRÓXIMOS PASSOS:**

1. **Testar localmente** com `start-docker.bat`
2. **Compartilhar com parceiro** via GitHub
3. **Configurar banco compartilhado** (opcional)
4. **Implementar workflow** de desenvolvimento
5. **Configurar CI/CD** (opcional)

---

**🎯 Docker configurado com sucesso! Agora vocês podem trabalhar em equipe de forma eficiente!**
