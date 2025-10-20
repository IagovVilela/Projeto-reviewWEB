@echo off
echo 📧 CONFIGURADOR DE EMAIL SMTP - REVIEWS PLATFORM
echo ================================================
echo.

echo 🎯 Escolha uma opção de email:
echo.
echo 1️⃣ Gmail (Recomendado para testes)
echo 2️⃣ SendGrid (Recomendado para produção)
echo 3️⃣ Mailtrap (Para desenvolvimento)
echo 4️⃣ Configuração manual
echo.

set /p choice="Digite sua escolha (1-4): "

if "%choice%"=="1" goto gmail
if "%choice%"=="2" goto sendgrid
if "%choice%"=="3" goto mailtrap
if "%choice%"=="4" goto manual
goto invalid

:gmail
echo.
echo 📧 CONFIGURAÇÃO GMAIL
echo ====================
echo.
echo ⚠️ IMPORTANTE: Você precisa de uma "Senha de App" do Gmail!
echo.
echo 📋 Passos para obter senha de app:
echo 1. Acesse: https://myaccount.google.com/
echo 2. Vá em "Segurança" → "Verificação em duas etapas"
echo 3. Ative a verificação em duas etapas
echo 4. Vá em "Senhas de app"
echo 5. Gere uma nova senha para "Mail"
echo 6. Copie a senha gerada (16 caracteres)
echo.
set /p gmail_email="Digite seu email Gmail: "
set /p gmail_password="Digite a senha de app (16 caracteres): "
echo.
echo 🔧 Configurando Gmail...
(
echo MAIL_MAILER=smtp
echo MAIL_HOST=smtp.gmail.com
echo MAIL_PORT=587
echo MAIL_USERNAME=%gmail_email%
echo MAIL_PASSWORD=%gmail_password%
echo MAIL_ENCRYPTION=tls
echo MAIL_FROM_ADDRESS=%gmail_email%
echo MAIL_FROM_NAME="Reviews Platform"
) > .env.email
echo ✅ Configuração Gmail salva em .env.email
goto test

:sendgrid
echo.
echo 📧 CONFIGURAÇÃO SENDGRID
echo =======================
echo.
echo 📋 Passos para obter API Key:
echo 1. Acesse: https://sendgrid.com/
echo 2. Crie uma conta gratuita
echo 3. Vá em "Settings" → "API Keys"
echo 4. Crie uma nova API Key
echo 5. Copie a chave gerada
echo.
set /p sendgrid_email="Digite o email remetente: "
set /p sendgrid_key="Digite a API Key do SendGrid: "
echo.
echo 🔧 Configurando SendGrid...
(
echo MAIL_MAILER=smtp
echo MAIL_HOST=smtp.sendgrid.net
echo MAIL_PORT=587
echo MAIL_USERNAME=apikey
echo MAIL_PASSWORD=%sendgrid_key%
echo MAIL_ENCRYPTION=tls
echo MAIL_FROM_ADDRESS=%sendgrid_email%
echo MAIL_FROM_NAME="Reviews Platform"
) > .env.email
echo ✅ Configuração SendGrid salva em .env.email
goto test

:mailtrap
echo.
echo 📧 CONFIGURAÇÃO MAILTRAP
echo =======================
echo.
echo 📋 Passos para obter credenciais:
echo 1. Acesse: https://mailtrap.io/
echo 2. Crie uma conta gratuita
echo 3. Vá em "Inboxes" → "My Inbox"
echo 4. Copie as credenciais SMTP
echo.
set /p mailtrap_username="Digite o username do Mailtrap: "
set /p mailtrap_password="Digite a senha do Mailtrap: "
echo.
echo 🔧 Configurando Mailtrap...
(
echo MAIL_MAILER=smtp
echo MAIL_HOST=sandbox.smtp.mailtrap.io
echo MAIL_PORT=2525
echo MAIL_USERNAME=%mailtrap_username%
echo MAIL_PASSWORD=%mailtrap_password%
echo MAIL_ENCRYPTION=tls
echo MAIL_FROM_ADDRESS=test@mailtrap.io
echo MAIL_FROM_NAME="Reviews Platform"
) > .env.email
echo ✅ Configuração Mailtrap salva em .env.email
goto test

:manual
echo.
echo 📧 CONFIGURAÇÃO MANUAL
echo =====================
echo.
set /p manual_host="Digite o host SMTP: "
set /p manual_port="Digite a porta (ex: 587): "
set /p manual_username="Digite o username: "
set /p manual_password="Digite a senha: "
set /p manual_encryption="Digite a criptografia (tls/ssl): "
set /p manual_from="Digite o email remetente: "
echo.
echo 🔧 Configurando manualmente...
(
echo MAIL_MAILER=smtp
echo MAIL_HOST=%manual_host%
echo MAIL_PORT=%manual_port%
echo MAIL_USERNAME=%manual_username%
echo MAIL_PASSWORD=%manual_password%
echo MAIL_ENCRYPTION=%manual_encryption%
echo MAIL_FROM_ADDRESS=%manual_from%
echo MAIL_FROM_NAME="Reviews Platform"
) > .env.email
echo ✅ Configuração manual salva em .env.email
goto test

:test
echo.
echo 🧪 DESEJA TESTAR A CONFIGURAÇÃO?
echo.
set /p test_choice="Digite 's' para testar ou 'n' para pular: "
if /i "%test_choice%"=="s" goto run_test
if /i "%test_choice%"=="n" goto finish
goto test

:run_test
echo.
echo 🧪 EXECUTANDO TESTE DE EMAIL...
echo.
php test-email.php
goto finish

:finish
echo.
echo ✅ CONFIGURAÇÃO CONCLUÍDA!
echo.
echo 📝 PRÓXIMOS PASSOS:
echo 1. Copie o conteúdo de .env.email para o arquivo .env
echo 2. Execute: php artisan config:clear
echo 3. Teste o sistema de notificações
echo.
echo 📖 Para mais detalhes, consulte: EMAIL_SETUP_GUIDE.md
echo.
pause
goto end

:invalid
echo.
echo ❌ Opção inválida! Escolha entre 1-4.
echo.
pause
goto end

:end
