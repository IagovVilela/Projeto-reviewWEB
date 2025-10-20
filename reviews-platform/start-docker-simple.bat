@echo off
echo 🐳 INICIANDO REVIEWS PLATFORM COM DOCKER
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

echo 🚀 Iniciando containers...
docker-compose up -d

echo.
echo ⏳ Aguardando inicialização...
timeout /t 10 /nobreak > nul

echo.
echo 📊 Status dos containers:
docker-compose ps

echo.
echo 📝 Logs da aplicação:
docker-compose logs app --tail=20

echo.
echo 🌐 Aplicação disponível em: http://localhost:8000
echo 🔑 Login: admin@reviewsplatform.com / admin123
echo.

echo ✅ Configuração concluída!
echo.
echo 💡 Comandos úteis:
echo    - Ver logs: docker-compose logs app
echo    - Parar: docker-compose down
echo    - Rebuild: docker-compose up --build -d
echo.

pause
