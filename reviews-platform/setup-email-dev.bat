@echo off
echo 📧 CONFIGURAÇÃO SIMPLES DE EMAIL
echo ================================
echo.

echo 🎯 Vamos usar uma configuração que funciona para desenvolvimento!
echo.

echo 🔧 Configurando email para desenvolvimento...

REM Backup do .env atual
copy .env .env.backup

REM Configurar para desenvolvimento (sem envio real)
powershell -Command "(Get-Content .env) -replace 'MAIL_MAILER=.*', 'MAIL_MAILER=log' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_HOST=.*', 'MAIL_HOST=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_PORT=.*', 'MAIL_PORT=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_USERNAME=.*', 'MAIL_USERNAME=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_PASSWORD=.*', 'MAIL_PASSWORD=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_ENCRYPTION=.*', 'MAIL_ENCRYPTION=' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_FROM_ADDRESS=.*', 'MAIL_FROM_ADDRESS=noreply@reviewsplatform.com' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'MAIL_FROM_NAME=.*', 'MAIL_FROM_NAME=Reviews Platform' | Set-Content .env"

echo ✅ Configuração salva!
echo.

echo 🧪 Testando configuração...
php artisan config:clear

echo.
echo 📧 CONFIGURAÇÃO ATUAL:
echo - MAIL_MAILER: log (emails salvos em storage/logs)
echo - MAIL_FROM_ADDRESS: noreply@reviewsplatform.com
echo - MAIL_FROM_NAME: Reviews Platform
echo.

echo 📁 Os emails serão salvos em: storage/logs/laravel.log
echo.

echo 🧪 Testando envio de email...
php test-email.php

echo.
echo ✅ CONFIGURAÇÃO CONCLUÍDA!
echo.
echo 📝 PRÓXIMOS PASSOS:
echo 1. Os emails serão salvos em logs (não enviados)
echo 2. Para enviar emails reais, configure SMTP depois
echo 3. Teste o sistema de notificações
echo.

pause
