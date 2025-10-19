@echo off
echo 🛑 Parando Reviews Platform...
echo.

echo 🐳 Parando containers...
docker-compose down

echo.
echo 🧹 Limpando volumes (opcional)...
set /p choice="Deseja remover volumes do banco? (y/N): "
if /i "%choice%"=="y" (
    docker-compose down -v
    echo ✅ Volumes removidos!
) else (
    echo ✅ Volumes mantidos!
)

echo.
echo 📊 Status final:
docker-compose ps

echo.
echo ✅ Containers parados! Pressione qualquer tecla para continuar...
pause
