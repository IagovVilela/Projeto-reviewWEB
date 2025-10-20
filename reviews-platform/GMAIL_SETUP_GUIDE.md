# 📧 **COMO ENCONTRAR "SENHAS DE APP" NO GMAIL**

## 🎯 **LOCALIZAÇÃO:**

### **Opção 1: Na página atual**
1. **Role para baixo** na página de "Verificação em duas etapas"
2. **Procure por "Senhas de app"** ou **"App passwords"**
3. **Clique nessa opção**

### **Opção 2: Menu lateral**
1. **Clique no menu lateral** (três linhas) no canto superior esquerdo
2. **Vá em "Segurança"**
3. **Procure por "Senhas de app"**

### **Opção 3: Link direto**
1. **Acesse diretamente:** https://myaccount.google.com/apppasswords
2. **Se não aparecer**, volte para a página de segurança

---

## 📋 **PASSOS PARA GERAR SENHA:**

### **1. Acessar Senhas de App:**
- Procure por **"Senhas de app"** ou **"App passwords"**
- Pode estar em uma seção separada

### **2. Selecionar Aplicativo:**
- **Escolha "Mail"** ou **"Outro"**
- **Digite:** "Reviews Platform"

### **3. Gerar Senha:**
- **Clique em "Gerar"**
- **Copie a senha** (16 caracteres)
- **Exemplo:** `abcd efgh ijkl mnop`

### **4. Usar no Sistema:**
- **Email:** seu-email@gmail.com
- **Senha:** senha-de-app-gerada (sem espaços)

---

## 🔍 **SE NÃO ENCONTRAR:**

### **Alternativa 1: Configuração Manual**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=senha-de-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="Reviews Platform"
```

### **Alternativa 2: Mailtrap (Mais Fácil)**
1. **Acesse:** https://mailtrap.io/
2. **Crie conta gratuita**
3. **Copie as credenciais SMTP**
4. **Use no sistema**

---

## ⚠️ **IMPORTANTE:**

- **NÃO use sua senha normal** do Gmail
- **Use APENAS senha de app** (16 caracteres)
- **A verificação em duas etapas** deve estar ativa
- **Teste sempre** após configurar

---

**🎯 Encontrou "Senhas de app"? Execute o script `setup-gmail-simple.bat` quando tiver a senha!**
