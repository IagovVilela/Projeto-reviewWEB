@echo off
chcp 65001 >nul 2>&1
setlocal enabledelayedexpansion

echo.
echo ========================================
echo    🚀 INICIAR APLICAÇÃO (CORRIGIDO)
echo ========================================
echo.

:: Cores para output
set "GREEN=[92m"
set "RED=[91m"
set "YELLOW=[93m"
set "BLUE=[94m"
set "RESET=[0m"

echo %BLUE%[INFO]%RESET% Navegando para o diretório do projeto...
cd /d "C:\Users\IAGO VILELA\Documents\PROJETOS"

echo %BLUE%[INFO]%RESET% Verificando se estamos no lugar certo...
if not exist "reviews-platform" (
    echo %RED%[ERROR]%RESET% Diretório 'reviews-platform' não encontrado!
    echo %YELLOW%[INFO]%RESET% Diretório atual: %cd%
    echo %BLUE%[INFO]%RESET% Certifique-se de que o projeto está em: C:\Users\IAGO VILELA\Documents\PROJETOS
    echo.
    echo %BLUE%[INFO]%RESET% Pressione qualquer tecla para sair...
    pause >nul
    exit /b 1
)

echo %GREEN%[SUCCESS]%RESET% Projeto encontrado! ✓

cd reviews-platform

echo %BLUE%[INFO]%RESET% Verificando arquivo .env...
if not exist ".env" (
    echo %YELLOW%[WARNING]%RESET% Criando arquivo .env...
    if exist ".env.example" (
        copy ".env.example" ".env" >nul
        echo %GREEN%[SUCCESS]%RESET% Arquivo .env criado ✓
    ) else (
        echo %RED%[ERROR]%RESET% Arquivo .env.example não encontrado!
        echo %BLUE%[INFO]%RESET% Pressione qualquer tecla para sair...
        pause >nul
        exit /b 1
    )
) else (
    echo %GREEN%[SUCCESS]%RESET% Arquivo .env já existe ✓
)

echo %BLUE%[INFO]%RESET% Gerando chave da aplicação...
php artisan key:generate --force >nul 2>&1
echo %GREEN%[SUCCESS]%RESET% Chave gerada ✓

echo.
echo %BLUE%[INFO]%RESET% Iniciando servidor Laravel...
start "Laravel Backend" cmd /k "cd /d %cd% && echo [LARAVEL] Iniciando servidor... && php artisan serve && echo. && echo [LARAVEL] Servidor rodando em: http://localhost:8000"

echo %BLUE%[INFO]%RESET% Aguardando Laravel iniciar...
timeout /t 3 /nobreak >nul

echo.
echo %BLUE%[INFO]%RESET% Verificando diretório frontend...
if not exist "frontend" (
    echo %RED%[ERROR]%RESET% Diretório 'frontend' não encontrado!
    echo %BLUE%[INFO]%RESET% Pressione qualquer tecla para sair...
    pause >nul
    exit /b 1
)

echo %GREEN%[SUCCESS]%RESET% Diretório frontend encontrado ✓

echo.
echo %BLUE%[INFO]%RESET% Iniciando servidor React...
start "React Frontend" cmd /k "cd /d %cd%\frontend && echo [REACT] Iniciando servidor... && npm run dev && echo. && echo [REACT] Servidor rodando em: http://localhost:5173"

echo.
echo %GREEN%[SUCCESS]%RESET% ========================================
echo %GREEN%[SUCCESS]%RESET%    APLICAÇÃO INICIADA COM SUCESSO!
echo %GREEN%[SUCCESS]%RESET% ========================================
echo.
echo %BLUE%[INFO]%RESET% URLs da aplicação:
echo    • Frontend React: http://localhost:5173
echo    • Backend Laravel: http://localhost:8000
echo.
echo %YELLOW%[IMPORTANTE]%RESET% Para parar os servidores:
echo    • Feche as janelas dos servidores
echo    • Ou pressione Ctrl+C em cada janela
echo.
echo %BLUE%[INFO]%RESET% Esta janela pode ser fechada agora.
echo %BLUE%[INFO]%RESET% Pressione qualquer tecla para fechar...
pause >nul
