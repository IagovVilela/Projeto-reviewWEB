@echo off
echo 🔄 REVERTENDO PARA AMBIENTE LOCAL
echo.

echo 📋 Parando Docker...
docker-compose down

echo.
echo 🔧 Configurando .env para MySQL local...
echo DB_HOST=127.0.0.1 > .env.temp
echo DB_USERNAME=root >> .env.temp
echo DB_PASSWORD= >> .env.temp
echo DB_DATABASE=reviews_platform >> .env.temp
echo DB_PORT=3306 >> .env.temp

echo.
echo 📊 Configuração atual:
type .env.temp

echo.
echo ⚠️  IMPORTANTE: Configure seu MySQL local com:
echo    - Host: 127.0.0.1
echo    - Usuário: root
echo    - Senha: (vazia)
echo    - Database: reviews_platform
echo.

echo 🚀 Para iniciar o servidor Laravel:
echo    php artisan serve
echo.

pause
