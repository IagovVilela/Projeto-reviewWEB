@echo off
echo 📧 CONFIGURAÇÃO ALTERNATIVA - MAILTRAP (MAIS FÁCIL)
echo ==================================================
echo.

echo 🎯 Mailtrap é mais fácil que Gmail para testes!
echo.
echo 📋 Passos rápidos:
echo 1. Acesse: https://mailtrap.io/
echo 2. Clique em "Sign Up" (gratuito)
echo 3. Crie uma conta
echo 4. Vá em "Inboxes" → "My Inbox"
echo 5. Copie as credenciais SMTP
echo.

set /p mailtrap_username="Digite o username do Mailtrap: "
set /p mailtrap_password="Digite a senha do Mailtrap: "

echo.
echo 🔧 Configurando Mailtrap...

REM Backup do .env atual
copy .env .env.backup

REM Atualizar configurações de email
powershell -Command "(Get-Content .env) -replace 'MAIL_HOST=.*', 'MAIL_HOST=sandbox.smtp.mailtrap.io' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_PORT=.*', 'MAIL_PORT=2525' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_USERNAME=.*', 'MAIL_USERNAME=%mailtrap_username%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_PASSWORD=.*', 'MAIL_PASSWORD=%mailtrap_password%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_FROM_ADDRESS=.*', 'MAIL_FROM_ADDRESS=test@mailtrap.io' | Set-Content .env"

echo ✅ Configuração Mailtrap salva!
echo.

echo 🧪 Testando configuração...
php artisan config:clear

echo.
echo 📧 Para testar o email, execute:
echo    php test-email.php
echo.

echo 🌐 Ou acesse: http://localhost:8000/login
echo    Email: admin@reviewsplatform.com
echo    Senha: admin123
echo.

echo 📖 Vantagens do Mailtrap:
echo - ✅ Mais fácil de configurar
echo - ✅ Não precisa de senha de app
echo - ✅ Ideal para desenvolvimento
echo - ✅ Emails ficam na caixa do Mailtrap
echo.

pause
