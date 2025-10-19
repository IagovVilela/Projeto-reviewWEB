@echo off
echo 🚀 Iniciando Reviews Platform com Docker...
echo.

echo 📋 Verificando Docker...
docker --version
if %errorlevel% neq 0 (
    echo ❌ Docker não encontrado! Instale o Docker Desktop primeiro.
    pause
    exit /b 1
)

echo ✅ Docker encontrado!
echo.

echo 🔧 Configurando ambiente...
if not exist .env (
    echo 📝 Criando arquivo .env...
    copy .env.docker .env
    echo ✅ Arquivo .env criado!
) else (
    echo ✅ Arquivo .env já existe!
)

echo.
echo 🐳 Iniciando containers...
docker-compose up -d

echo.
echo ⏳ Aguardando containers iniciarem...
timeout /t 10

echo.
echo 📊 Status dos containers:
docker-compose ps

echo.
echo 🌐 Aplicação disponível em: http://localhost:8000
echo 🗄️ MySQL disponível em: localhost:3306
echo 📊 Redis disponível em: localhost:6379
echo.

echo 📋 Comandos úteis:
echo   - Ver logs: docker-compose logs -f app
echo   - Parar: docker-compose down
echo   - Rebuild: docker-compose up --build
echo   - Acessar app: docker-compose exec app bash
echo   - Acessar MySQL: docker-compose exec mysql mysql -u reviews_user -p reviews_platform
echo.

echo ✅ Setup concluído! Pressione qualquer tecla para continuar...
pause
