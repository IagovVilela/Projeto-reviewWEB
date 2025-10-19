@echo off
chcp 65001 >nul 2>&1
setlocal enabledelayedexpansion

echo.
echo ========================================
echo    INICIAR APLICACAO - Reviews Platform
echo ========================================
echo.

cd /d "C:\Users\Mpbit\Documents\Projeto\Projeto-reviewWEB\reviews-platform"

echo [1/3] Verificando estrutura do projeto...

if not exist "app" (
    echo [ERRO] Projeto nao encontrado!
    echo Diretorio atual: %cd%
    pause
    exit /b 1
)

if not exist ".env" (
    echo [ERRO] Arquivo .env nao encontrado!
    pause
    exit /b 1
)

echo [OK] Projeto encontrado!

echo.
echo [2/3] Verificando dependencias...

if not exist "vendor\autoload.php" (
    echo [AVISO] Instalando dependencias do Composer...
    composer install --no-interaction --ignore-platform-reqs
)

echo [OK] Dependencias verificadas!

echo.
echo [3/3] Iniciando servidor Laravel...
start "Laravel Backend - Reviews Platform" cmd /k "cd /d %cd% && echo ========================================= && echo    REVIEWS PLATFORM - LARAVEL && echo ========================================= && echo. && echo Servidor iniciando... && echo. && php artisan serve && echo. && echo Acesse: http://localhost:8000 && pause"

timeout /t 2 /nobreak >nul

echo.
echo =========================================
echo    APLICACAO INICIADA COM SUCESSO!
echo =========================================
echo.
echo Acesse a aplicacao em:
echo.
echo   http://localhost:8000
echo.
echo Para parar o servidor:
echo   - Feche a janela que abriu
echo   - Ou pressione Ctrl+C na janela
echo.
echo Esta janela pode ser fechada agora.
echo.
pause
