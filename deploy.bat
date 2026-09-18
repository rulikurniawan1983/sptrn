@echo off
REM Laravel Cloud Deployment Script for Windows
REM Run this script after deployment to production

echo ========================================
echo   SPARTAN Production Deployment
echo ========================================
echo.

REM Check if .env exists
if not exist .env (
    echo ERROR: .env file not found!
    echo Please create .env file from .env.production template
    pause
    exit /b 1
)

REM Generate APP_KEY if needed
echo [1/6] Checking APP_KEY...
php artisan key:generate --force

REM Install/update dependencies
echo.
echo [2/6] Installing Composer dependencies...
composer install --no-dev --optimize-autoloader --no-interaction

REM Run database migrations
echo.
echo [3/6] Running database migrations...
php artisan migrate --force --no-interaction

REM Seed database if needed
echo.
echo [4/6] Seeding database...
php artisan db:seed --force --no-interaction
if errorlevel 1 (
    echo Warning: Seeding failed or not needed
)

REM Create storage link
echo.
echo [5/6] Creating storage link...
php artisan storage:link --force
if errorlevel 1 (
    echo Warning: Storage link already exists or failed
)

REM Clear and cache configurations
echo.
echo [6/6] Optimizing application...
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

echo.
echo ========================================
echo   Deployment Complete!
echo ========================================
pause
