# 📧 **CONFIGURAÇÃO DE EMAIL SMTP - GUIA COMPLETO**

## 🎯 **OPÇÕES DISPONÍVEIS:**

### **1. Gmail (Recomendado para testes)**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="Reviews Platform"
```

**⚠️ IMPORTANTE:** Use "Senha de App" do Gmail, não sua senha normal!

### **2. SendGrid (Recomendado para produção)**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=SG.sua-api-key-aqui
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@seudominio.com
MAIL_FROM_NAME="Reviews Platform"
```

### **3. Mailtrap (Para desenvolvimento/testes)**
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu-username-mailtrap
MAIL_PASSWORD=sua-senha-mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=test@mailtrap.io
MAIL_FROM_NAME="Reviews Platform"
```

---

## 🔧 **CONFIGURAÇÃO PASSO A PASSO:**

### **OPÇÃO 1: GMAIL (Mais Fácil)**

#### **1. Ativar Senha de App:**
1. Acesse: https://myaccount.google.com/
2. Vá em "Segurança" → "Verificação em duas etapas"
3. Ative a verificação em duas etapas
4. Vá em "Senhas de app"
5. Gere uma nova senha para "Mail"
6. Copie a senha gerada (16 caracteres)

#### **2. Configurar .env:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=senha-de-app-gerada
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="Reviews Platform"
```

### **OPÇÃO 2: SENDGRID (Profissional)**

#### **1. Criar Conta SendGrid:**
1. Acesse: https://sendgrid.com/
2. Crie uma conta gratuita (100 emails/dia)
3. Vá em "Settings" → "API Keys"
4. Crie uma nova API Key
5. Copie a chave gerada

#### **2. Configurar .env:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=SG.sua-api-key-aqui
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@seudominio.com
MAIL_FROM_NAME="Reviews Platform"
```

### **OPÇÃO 3: MAILTRAP (Desenvolvimento)**

#### **1. Criar Conta Mailtrap:**
1. Acesse: https://mailtrap.io/
2. Crie uma conta gratuita
3. Vá em "Inboxes" → "My Inbox"
4. Copie as credenciais SMTP

#### **2. Configurar .env:**
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=seu-username-mailtrap
MAIL_PASSWORD=sua-senha-mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=test@mailtrap.io
MAIL_FROM_NAME="Reviews Platform"
```

---

## 🧪 **TESTE DE CONFIGURAÇÃO:**

### **1. Testar Email:**
```bash
php artisan tinker
Mail::raw('Teste de email', function ($message) {
    $message->to('seu-email@teste.com')->subject('Teste');
});
```

### **2. Verificar Logs:**
```bash
tail -f storage/logs/laravel.log
```

### **3. Testar Notificação:**
```bash
php artisan tinker
$company = App\Models\Company::first();
$review = App\Models\Review::first();
Mail::to('seu-email@teste.com')->send(new App\Mail\NewReviewNotification($company, $review));
```

---

## 🆘 **SOLUÇÃO DE PROBLEMAS:**

### **Erro: Authentication failed**
- Verifique se a senha está correta
- Para Gmail, use senha de app, não senha normal
- Verifique se a verificação em duas etapas está ativa

### **Erro: Connection refused**
- Verifique se a porta está correta (587 para TLS)
- Verifique se o firewall não está bloqueando
- Teste com Mailtrap primeiro

### **Erro: SSL/TLS**
- Verifique se MAIL_ENCRYPTION=tls
- Para Gmail, use porta 587 com TLS

---

## 📝 **PRÓXIMOS PASSOS:**

1. **Escolha uma opção** (Gmail recomendado para começar)
2. **Configure as credenciais** no .env
3. **Execute o teste** de email
4. **Verifique os logs** se houver erro
5. **Teste as notificações** do sistema

---

**🎯 Qual opção você quer usar? Gmail, SendGrid ou Mailtrap?**
