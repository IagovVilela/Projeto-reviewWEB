@echo off
echo 🐳 Alternando para configuração Docker...
echo.

if exist .env.backup (
    echo 📋 Restaurando configuração anterior...
    copy .env.backup .env
    echo ✅ Configuração restaurada!
) else (
    echo 📋 Fazendo backup da configuração atual...
    copy .env .env.backup
    echo ✅ Backup criado!
)

echo 🔧 Aplicando configuração Docker...
@"
APP_NAME="Reviews Platform"
APP_ENV=local
APP_KEY=base64:q+McGHcOfINLdU7hA2NtXQXJhE6oOFO0J3ipA9xRNV0=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=reviews_platform
DB_USERNAME=reviews_user
DB_PASSWORD=reviews_pass

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@reviewsplatform.com
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
"@ | Out-File -FilePath .env -Encoding UTF8

echo ✅ Configuração Docker aplicada!
echo.
echo 🐳 Configuração atual: DOCKER (mysql)
echo 📋 Para usar local, execute: switch-to-local.bat
echo.
echo 📋 Próximos passos:
echo   1. Execute: start-docker.bat
echo   2. Ou: docker-compose up -d
echo.
pause
