@echo off
chcp 65001 >nul 2>&1
setlocal enabledelayedexpansion

echo.
echo ========================================
echo    🔍 DIAGNÓSTICO COMPLETO DO SISTEMA
echo ========================================
echo.

:: Cores para output
set "GREEN=[92m"
set "RED=[91m"
set "YELLOW=[93m"
set "BLUE=[94m"
set "CYAN=[96m"
set "RESET=[0m"

echo %CYAN%[DIAGNÓSTICO]%RESET% Verificando ambiente de desenvolvimento...
echo.

:: ========================================
:: 1. VERIFICAR SOFTWARE INSTALADO
:: ========================================
echo %BLUE%[1/8]%RESET% Verificando software instalado...
echo.

:: PHP
echo %BLUE%[INFO]%RESET% Verificando PHP...
php --version >nul 2>&1
if %errorlevel% equ 0 (
    for /f "tokens=2" %%i in ('php --version ^| findstr "PHP"') do set PHP_VERSION=%%i
    echo %GREEN%[✓]%RESET% PHP instalado: !PHP_VERSION!
) else (
    echo %RED%[✗]%RESET% PHP não encontrado
    echo %YELLOW%[INFO]%RESET% Baixe em: https://www.php.net/downloads.php
)

:: Composer
echo %BLUE%[INFO]%RESET% Verificando Composer...
composer --version >nul 2>&1
if %errorlevel% equ 0 (
    for /f "tokens=3" %%i in ('composer --version') do set COMPOSER_VERSION=%%i
    echo %GREEN%[✓]%RESET% Composer instalado: !COMPOSER_VERSION!
) else (
    echo %RED%[✗]%RESET% Composer não encontrado
    echo %YELLOW%[INFO]%RESET% Baixe em: https://getcomposer.org/download/
)

:: Node.js
echo %BLUE%[INFO]%RESET% Verificando Node.js...
node --version >nul 2>&1
if %errorlevel% equ 0 (
    for /f %%i in ('node --version') do set NODE_VERSION=%%i
    echo %GREEN%[✓]%RESET% Node.js instalado: !NODE_VERSION!
) else (
    echo %RED%[✗]%RESET% Node.js não encontrado
    echo %YELLOW%[INFO]%RESET% Baixe em: https://nodejs.org/
)

:: NPM
echo %BLUE%[INFO]%RESET% Verificando NPM...
npm --version >nul 2>&1
if %errorlevel% equ 0 (
    for /f %%i in ('npm --version') do set NPM_VERSION=%%i
    echo %GREEN%[✓]%RESET% NPM instalado: !NPM_VERSION!
) else (
    echo %RED%[✗]%RESET% NPM não encontrado
)

:: MySQL
echo %BLUE%[INFO]%RESET% Verificando MySQL...
mysql --version >nul 2>&1
if %errorlevel% equ 0 (
    for /f "tokens=3" %%i in ('mysql --version') do set MYSQL_VERSION=%%i
    echo %GREEN%[✓]%RESET% MySQL instalado: !MYSQL_VERSION!
) else (
    echo %RED%[✗]%RESET% MySQL não encontrado no PATH
    echo %YELLOW%[INFO]%RESET% Instale XAMPP ou adicione MySQL ao PATH
)

:: Git
echo %BLUE%[INFO]%RESET% Verificando Git...
git --version >nul 2>&1
if %errorlevel% equ 0 (
    for /f "tokens=3" %%i in ('git --version') do set GIT_VERSION=%%i
    echo %GREEN%[✓]%RESET% Git instalado: !GIT_VERSION!
) else (
    echo %RED%[✗]%RESET% Git não encontrado
    echo %YELLOW%[INFO]%RESET% Baixe em: https://git-scm.com/downloads
)

echo.

:: ========================================
:: 2. VERIFICAR XAMPP
:: ========================================
echo %BLUE%[2/8]%RESET% Verificando XAMPP...
echo.

if exist "C:\xampp" (
    echo %GREEN%[✓]%RESET% XAMPP encontrado em C:\xampp
    
    :: Verificar Apache
    netstat -an | findstr :80 >nul 2>&1
    if %errorlevel% equ 0 (
        echo %GREEN%[✓]%RESET% Apache está rodando (porta 80)
    ) else (
        echo %RED%[✗]%RESET% Apache não está rodando
        echo %YELLOW%[INFO]%RESET% Inicie Apache no XAMPP Control Panel
    )
    
    :: Verificar MySQL
    netstat -an | findstr :3306 >nul 2>&1
    if %errorlevel% equ 0 (
        echo %GREEN%[✓]%RESET% MySQL está rodando (porta 3306)
    ) else (
        echo %RED%[✗]%RESET% MySQL não está rodando
        echo %YELLOW%[INFO]%RESET% Inicie MySQL no XAMPP Control Panel
    )
    
    :: Verificar phpMyAdmin
    if exist "C:\xampp\htdocs\phpmyadmin" (
        echo %GREEN%[✓]%RESET% phpMyAdmin encontrado
    ) else (
        echo %RED%[✗]%RESET% phpMyAdmin não encontrado
    )
) else (
    echo %RED%[✗]%RESET% XAMPP não encontrado
    echo %YELLOW%[INFO]%RESET% Baixe em: https://www.apachefriends.org/download.html
)

echo.

:: ========================================
:: 3. VERIFICAR PROJETO
:: ========================================
echo %BLUE%[3/8]%RESET% Verificando projeto...
echo.

:: Navegar para o diretório do projeto
cd /d "C:\Users\%USERNAME%\Documents\PROJETOS" 2>nul
if %errorlevel% neq 0 (
    echo %RED%[✗]%RESET% Diretório PROJETOS não encontrado
    echo %YELLOW%[INFO]%RESET% Crie o diretório: C:\Users\%USERNAME%\Documents\PROJETOS
    goto :end
)

if exist "reviews-platform" (
    echo %GREEN%[✓]%RESET% Projeto reviews-platform encontrado
    
    cd reviews-platform
    
    :: Verificar arquivo .env
    if exist ".env" (
        echo %GREEN%[✓]%RESET% Arquivo .env existe
    ) else (
        echo %RED%[✗]%RESET% Arquivo .env não encontrado
        echo %YELLOW%[INFO]%RESET% Execute: cp .env.example .env
    )
    
    :: Verificar vendor
    if exist "vendor" (
        echo %GREEN%[✓]%RESET% Dependências PHP instaladas (vendor/)
    ) else (
        echo %RED%[✗]%RESET% Dependências PHP não instaladas
        echo %YELLOW%[INFO]%RESET% Execute: composer install
    )
    
    :: Verificar frontend
    if exist "frontend" (
        echo %GREEN%[✓]%RESET% Diretório frontend encontrado
        
        cd frontend
        if exist "node_modules" (
            echo %GREEN%[✓]%RESET% Dependências Node.js instaladas
        ) else (
            echo %RED%[✗]%RESET% Dependências Node.js não instaladas
            echo %YELLOW%[INFO]%RESET% Execute: npm install
        )
        cd ..
    ) else (
        echo %RED%[✗]%RESET% Diretório frontend não encontrado
    )
    
    :: Verificar storage link
    if exist "public\storage" (
        echo %GREEN%[✓]%RESET% Storage link criado
    ) else (
        echo %RED%[✗]%RESET% Storage link não criado
        echo %YELLOW%[INFO]%RESET% Execute: php artisan storage:link
    )
    
) else (
    echo %RED%[✗]%RESET% Projeto reviews-platform não encontrado
    echo %YELLOW%[INFO]%RESET% Certifique-se de que o projeto está em: C:\Users\%USERNAME%\Documents\PROJETOS\reviews-platform
)

echo.

:: ========================================
:: 4. VERIFICAR BANCO DE DADOS
:: ========================================
echo %BLUE%[4/8]%RESET% Verificando banco de dados...
echo.

:: Testar conexão MySQL
mysql -u root -e "SELECT 1;" >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% Conexão MySQL bem-sucedida
    
    :: Verificar se o banco existe
    mysql -u root -e "USE reviews_platform; SELECT 1;" >nul 2>&1
    if %errorlevel% equ 0 (
        echo %GREEN%[✓]%RESET% Banco reviews_platform existe
        
        :: Verificar tabelas
        for /f %%i in ('mysql -u root -e "USE reviews_platform; SHOW TABLES;" 2^>nul ^| find /c /v ""') do set TABLE_COUNT=%%i
        if !TABLE_COUNT! gtr 0 (
            echo %GREEN%[✓]%RESET% Tabelas encontradas: !TABLE_COUNT!
        ) else (
            echo %RED%[✗]%RESET% Nenhuma tabela encontrada
            echo %YELLOW%[INFO]%RESET% Execute: php artisan migrate
        )
    ) else (
        echo %RED%[✗]%RESET% Banco reviews_platform não existe
        echo %YELLOW%[INFO]%RESET% Crie o banco: CREATE DATABASE reviews_platform;
    )
) else (
    echo %RED%[✗]%RESET% Não foi possível conectar ao MySQL
    echo %YELLOW%[INFO]%RESET% Verifique se MySQL está rodando
)

echo.

:: ========================================
:: 5. VERIFICAR EXTENSÕES PHP
:: ========================================
echo %BLUE%[5/8]%RESET% Verificando extensões PHP...
echo.

php -m | findstr "pdo" >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% PDO: OK
) else (
    echo %RED%[✗]%RESET% PDO: Não encontrado
)

php -m | findstr "pdo_mysql" >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% PDO MySQL: OK
) else (
    echo %RED%[✗]%RESET% PDO MySQL: Não encontrado
)

php -m | findstr "mbstring" >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% Mbstring: OK
) else (
    echo %RED%[✗]%RESET% Mbstring: Não encontrado
)

php -m | findstr "openssl" >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% OpenSSL: OK
) else (
    echo %RED%[✗]%RESET% OpenSSL: Não encontrado
)

php -m | findstr "tokenizer" >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% Tokenizer: OK
) else (
    echo %RED%[✗]%RESET% Tokenizer: Não encontrado
)

php -m | findstr "xml" >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% XML: OK
) else (
    echo %RED%[✗]%RESET% XML: Não encontrado
)

echo.

:: ========================================
:: 6. VERIFICAR PORTAS
:: ========================================
echo %BLUE%[6/8]%RESET% Verificando portas...
echo.

:: Porta 80 (Apache)
netstat -an | findstr :80 >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% Porta 80: Em uso (Apache)
) else (
    echo %YELLOW%[!]%RESET% Porta 80: Livre
)

:: Porta 3306 (MySQL)
netstat -an | findstr :3306 >nul 2>&1
if %errorlevel% equ 0 (
    echo %GREEN%[✓]%RESET% Porta 3306: Em uso (MySQL)
) else (
    echo %RED%[✗]%RESET% Porta 3306: Livre (MySQL não está rodando)
)

:: Porta 8000 (Laravel)
netstat -an | findstr :8000 >nul 2>&1
if %errorlevel% equ 0 (
    echo %YELLOW%[!]%RESET% Porta 8000: Em uso (Laravel pode estar rodando)
) else (
    echo %GREEN%[✓]%RESET% Porta 8000: Livre
)

:: Porta 5173 (React)
netstat -an | findstr :5173 >nul 2>&1
if %errorlevel% equ 0 (
    echo %YELLOW%[!]%RESET% Porta 5173: Em uso (React pode estar rodando)
) else (
    echo %GREEN%[✓]%RESET% Porta 5173: Livre
)

echo.

:: ========================================
:: 7. VERIFICAR CONFIGURAÇÃO LARAVEL
:: ========================================
echo %BLUE%[7/8]%RESET% Verificando configuração Laravel...
echo.

if exist "reviews-platform" (
    cd reviews-platform
    
    :: Verificar chave da aplicação
    php artisan key:generate --show >nul 2>&1
    if %errorlevel% equ 0 (
        echo %GREEN%[✓]%RESET% Laravel Artisan funcionando
    ) else (
        echo %RED%[✗]%RESET% Laravel Artisan com problemas
    )
    
    :: Verificar configuração
    php artisan config:show app.name >nul 2>&1
    if %errorlevel% equ 0 (
        echo %GREEN%[✓]%RESET% Configuração Laravel OK
    ) else (
        echo %RED%[✗]%RESET% Problema na configuração Laravel
    )
    
    :: Verificar migrations
    php artisan migrate:status >nul 2>&1
    if %errorlevel% equ 0 (
        echo %GREEN%[✓]%RESET% Migrations configuradas
    ) else (
        echo %RED%[✗]%RESET% Problema com migrations
    )
    
    cd ..
) else (
    echo %RED%[✗]%RESET% Não foi possível verificar Laravel (projeto não encontrado)
)

echo.

:: ========================================
:: 8. RESUMO E RECOMENDAÇÕES
:: ========================================
echo %BLUE%[8/8]%RESET% Resumo e recomendações...
echo.

echo %CYAN%[RESUMO]%RESET% Status do ambiente:
echo.

:: Contar problemas
set /a PROBLEMAS=0

:: Verificar PHP
php --version >nul 2>&1
if %errorlevel% neq 0 set /a PROBLEMAS+=1

:: Verificar Composer
composer --version >nul 2>&1
if %errorlevel% neq 0 set /a PROBLEMAS+=1

:: Verificar Node.js
node --version >nul 2>&1
if %errorlevel% neq 0 set /a PROBLEMAS+=1

:: Verificar MySQL
mysql --version >nul 2>&1
if %errorlevel% neq 0 set /a PROBLEMAS+=1

:: Verificar XAMPP
if not exist "C:\xampp" set /a PROBLEMAS+=1

:: Verificar projeto
if not exist "C:\Users\%USERNAME%\Documents\PROJETOS\reviews-platform" set /a PROBLEMAS+=1

if %PROBLEMAS% equ 0 (
    echo %GREEN%[✓]%RESET% Ambiente configurado corretamente!
    echo %GREEN%[✓]%RESET% Você pode executar: INICIAR_APLICACAO.bat
) else (
    echo %RED%[✗]%RESET% Encontrados %PROBLEMAS% problemas
    echo.
    echo %YELLOW%[RECOMENDAÇÕES]%RESET% Para resolver:
    echo.
    
    php --version >nul 2>&1
    if %errorlevel% neq 0 (
        echo %YELLOW%[1]%RESET% Instalar PHP 8.0+: https://www.php.net/downloads.php
    )
    
    composer --version >nul 2>&1
    if %errorlevel% neq 0 (
        echo %YELLOW%[2]%RESET% Instalar Composer: https://getcomposer.org/download/
    )
    
    node --version >nul 2>&1
    if %errorlevel% neq 0 (
        echo %YELLOW%[3]%RESET% Instalar Node.js 18+: https://nodejs.org/
    )
    
    mysql --version >nul 2>&1
    if %errorlevel% neq 0 (
        echo %YELLOW%[4]%RESET% Instalar XAMPP: https://www.apachefriends.org/download.html
    )
    
    if not exist "C:\xampp" (
        echo %YELLOW%[5]%RESET% Instalar XAMPP para MySQL e phpMyAdmin
    )
    
    if not exist "C:\Users\%USERNAME%\Documents\PROJETOS\reviews-platform" (
        echo %YELLOW%[6]%RESET% Copiar projeto para: C:\Users\%USERNAME%\Documents\PROJETOS\reviews-platform
    )
)

echo.
echo %CYAN%[PRÓXIMOS PASSOS]%RESET%
echo ========================
echo 1. Resolva os problemas identificados acima
echo 2. Execute este script novamente para verificar
echo 3. Quando tudo estiver OK, execute: INICIAR_APLICACAO.bat
echo 4. Acesse: http://localhost:8000 (Backend) e http://localhost:5173 (Frontend)
echo.

:end
echo %BLUE%[INFO]%RESET% Pressione qualquer tecla para sair...
pause >nul
