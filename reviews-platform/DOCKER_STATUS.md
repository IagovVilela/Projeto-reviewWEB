# 🐳 **CONFIGURAÇÃO DOCKER - GUIA SIMPLIFICADO**

## ✅ **STATUS ATUAL:**
- ✅ Docker instalado e funcionando
- ✅ Containers criados e rodando
- ✅ MySQL funcionando na porta 3306
- ✅ Redis funcionando na porta 6379
- ⚠️ Aplicação Laravel ainda inicializando

---

## 🚀 **COMANDOS ESSENCIAIS:**

### **1. Verificar Status:**
```bash
docker-compose ps
```

### **2. Ver Logs da Aplicação:**
```bash
docker-compose logs app
```

### **3. Parar Tudo:**
```bash
docker-compose down
```

### **4. Iniciar Tudo:**
```bash
docker-compose up -d
```

### **5. Rebuild (após mudanças):**
```bash
docker-compose up --build -d
```

---

## 🔧 **COMANDOS LARAVEL:**

### **Executar Migrations:**
```bash
docker-compose exec app php artisan migrate --force
```

### **Executar Seeders:**
```bash
docker-compose exec app php artisan db:seed --force
```

### **Limpar Cache:**
```bash
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
```

### **Acessar Container:**
```bash
docker-compose exec app bash
```

---

## 🌐 **ACESSO À APLICAÇÃO:**

### **URL Principal:**
- **Aplicação:** http://localhost:8000
- **Login:** http://localhost:8000/login

### **Credenciais Admin:**
- **Email:** admin@reviewsplatform.com
- **Senha:** admin123

---

## 📊 **BANCO DE DADOS:**

### **Conectar ao MySQL:**
```bash
docker-compose exec mysql mysql -u reviews_user -p reviews_platform
```

### **Senha:** reviews_pass

---

## 🆘 **SOLUÇÃO DE PROBLEMAS:**

### **Problema: Porta 3306 em uso**
```bash
# Verificar processo
netstat -ano | findstr :3306

# Parar processo
taskkill /PID [PID_NUMBER] /F
```

### **Problema: Container não inicia**
```bash
# Ver logs
docker-compose logs app

# Rebuild completo
docker-compose down
docker-compose up --build -d
```

### **Problema: Erro de permissão**
```bash
# Corrigir permissões
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

---

## 🎯 **PRÓXIMOS PASSOS:**

1. **Aguardar inicialização completa** (pode levar alguns minutos)
2. **Verificar logs:** `docker-compose logs app`
3. **Testar aplicação:** http://localhost:8000
4. **Fazer login:** admin@reviewsplatform.com / admin123

---

## 📝 **NOTAS IMPORTANTES:**

- ⏳ **Primeira inicialização:** Pode levar 2-5 minutos
- 🔄 **Hot reload:** Funciona automaticamente
- 💾 **Dados persistentes:** Salvos no volume Docker
- 🌐 **Acesso externo:** Funciona para toda a equipe

---

**🎉 Docker configurado com sucesso!**
