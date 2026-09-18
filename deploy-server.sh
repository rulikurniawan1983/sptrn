#!/usr/bin/env bash
# Laravel Cloud Post-Deployment Script
# This script runs on the Laravel Cloud server after deployment

set -e

APP_DIR="/home/sites/default"
cd "$APP_DIR" || exit 1

echo "========================================"
echo "  SPARTAN Post-Deployment Tasks"
echo "========================================"
echo ""

# Check if .env exists, if not copy from .env.local
if [ ! -f .env ]; then
    if [ -f .env.local ]; then
        echo "Copying .env.local to .env..."
        cp .env.local .env
    else
        echo "ERROR: .env file not found!"
        echo "Please create .env file from .env.local template"
        exit 1
    fi
fi

# Generate APP_KEY if it's still the placeholder
echo "[1/6] Checking APP_KEY..."
if grep -q "YOUR_PRODUCTION_APP_KEY_HERE" .env; then
    echo "Generating new APP_KEY..."
    php artisan key:generate --force
else
    echo "APP_KEY already set"
fi

# Install/update Composer dependencies
echo ""
echo "[2/6] Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Run database migrations
echo ""
echo "[3/6] Running database migrations..."
php artisan migrate --force --no-interaction

# Seed database (optional - comment out if not needed)
echo ""
echo "[4/6] Seeding database..."
php artisan db:seed --force --no-interaction || echo "Warning: Seeding failed or not needed"

# Create storage link
echo ""
echo "[5/6] Creating storage link..."
php artisan storage:link --force || echo "Warning: Storage link already exists"

# Clear and cache configurations
echo ""
echo "[6/6] Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Set proper permissions
echo ""
echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache || true

echo ""
echo "========================================"
echo "  Post-Deployment Complete!"
echo "========================================"
