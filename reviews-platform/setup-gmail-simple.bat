@echo off
echo 📧 CONFIGURAÇÃO SIMPLES DE EMAIL GMAIL
echo =====================================
echo.

echo ✅ Verificação em duas etapas: ATIVADA
echo.
echo 📋 Agora você precisa gerar uma "Senha de App":
echo.
echo 1. Na página do Google que está aberta
echo 2. Procure por "Senhas de app" ou "App passwords"
echo 3. Clique em "Senhas de app"
echo 4. Selecione "Mail" como aplicativo
echo 5. Copie a senha gerada (16 caracteres)
echo.

set /p gmail_email="Digite seu email Gmail: "
set /p gmail_password="Digite a senha de app (16 caracteres): "

echo.
echo 🔧 Configurando email no sistema...

REM Backup do .env atual
copy .env .env.backup

REM Atualizar configurações de email
powershell -Command "(Get-Content .env) -replace 'MAIL_USERNAME=.*', 'MAIL_USERNAME=%gmail_email%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_PASSWORD=.*', 'MAIL_PASSWORD=%gmail_password%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_FROM_ADDRESS=.*', 'MAIL_FROM_ADDRESS=%gmail_email%' | Set-Content .env"

echo ✅ Configuração salva!
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

pause
