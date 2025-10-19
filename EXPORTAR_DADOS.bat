@echo off
chcp 65001 >nul 2>&1
setlocal enabledelayedexpansion

echo.
echo ========================================
echo    📊 EXPORTAR DADOS PARA SEEDER
echo ========================================
echo.

:: Cores para output
set "GREEN=[92m"
set "RED=[91m"
set "YELLOW=[93m"
set "BLUE=[94m"
set "CYAN=[96m"
set "RESET=[0m"

echo %CYAN%[EXPORT]%RESET% Este script irá exportar seus dados atuais para criar seeders...
echo.

:: Navegar para o projeto
cd /d "C:\Users\%USERNAME%\Documents\PROJETOS\reviews-platform" 2>nul
if %errorlevel% neq 0 (
    echo %RED%[ERROR]%RESET% Projeto não encontrado!
    echo %YELLOW%[INFO]%RESET% Certifique-se de que o projeto está em: C:\Users\%USERNAME%\Documents\PROJETOS\reviews-platform
    goto :end
)

echo %GREEN%[✓]%RESET% Projeto encontrado!

:: Verificar se Laravel está funcionando
php artisan --version >nul 2>&1
if %errorlevel% neq 0 (
    echo %RED%[ERROR]%RESET% Laravel não está funcionando!
    echo %YELLOW%[INFO]%RESET% Execute primeiro: composer install
    goto :end
)

echo %GREEN%[✓]%RESET% Laravel funcionando!

echo.
echo %BLUE%[INFO]%RESET% Escolha uma opção:
echo.
echo %YELLOW%[1]%RESET% Exportar dados reais atuais
echo %YELLOW%[2]%RESET% Criar dados de demonstração completos
echo %YELLOW%[3]%RESET% Apenas dados básicos (admin + 3 empresas)
echo.
set /p choice="Digite sua escolha (1-3): "

if "%choice%"=="1" goto :export_real
if "%choice%"=="2" goto :create_complete
if "%choice%"=="3" goto :create_basic
goto :invalid_choice

:export_real
echo.
echo %BLUE%[EXPORT]%RESET% Exportando dados reais...
php artisan data:export-seeder --file=RealDataSeeder.php
if %errorlevel% equ 0 (
    echo %GREEN%[SUCCESS]%RESET% Dados exportados para: database/seeders/RealDataSeeder.php
    echo.
    echo %CYAN%[PRÓXIMOS PASSOS]%RESET%
    echo 1. Compartilhe o arquivo RealDataSeeder.php com seu parceiro
    echo 2. Ele deve colocar em: database/seeders/RealDataSeeder.php
    echo 3. Executar: php artisan db:seed --class=RealDataSeeder
) else (
    echo %RED%[ERROR]%RESET% Erro ao exportar dados!
)
goto :end

:create_complete
echo.
echo %BLUE%[CREATE]%RESET% Criando dados completos de demonstração...
php artisan db:seed --class=CompleteDataSeeder
if %errorlevel% equ 0 (
    echo %GREEN%[SUCCESS]%RESET% Dados completos criados!
    echo.
    echo %CYAN%[RESULTADO]%RESET%
    echo • 1 usuário admin (admin@example.com / password)
    echo • 10 empresas de diferentes segmentos
    echo • Páginas de avaliação para cada empresa
    echo • Avaliações realistas (positivas e negativas)
    echo.
    echo %YELLOW%[INFO]%RESET% Seu parceiro pode usar o CompleteDataSeeder também!
) else (
    echo %RED%[ERROR]%RESET% Erro ao criar dados!
)
goto :end

:create_basic
echo.
echo %BLUE%[CREATE]%RESET% Criando dados básicos...
php artisan db:seed --class=DemoDataSeeder
if %errorlevel% equ 0 (
    echo %GREEN%[SUCCESS]%RESET% Dados básicos criados!
    echo.
    echo %CYAN%[RESULTADO]%RESET%
    echo • 1 usuário admin (admin@example.com / password)
    echo • 3 empresas de exemplo
    echo • Páginas de avaliação
    echo • Algumas avaliações de teste
) else (
    echo %RED%[ERROR]%RESET% Erro ao criar dados!
)
goto :end

:invalid_choice
echo %RED%[ERROR]%RESET% Escolha inválida! Digite 1, 2 ou 3.
goto :end

:end
echo.
echo %BLUE%[INFO]%RESET% Pressione qualquer tecla para sair...
pause >nul
