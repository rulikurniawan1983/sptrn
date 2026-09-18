#!/usr/bin/env bash
# Laravel Cloud Deployment Script
# Run this script after deployment to production

set -e

echo "========================================"
echo "  SPARTAN Production Deployment"
echo "========================================"
echo ""

# Check if .env exists
if [ ! -f .env ]; then
    echo "ERROR: .env file not found!"
    echo "Please copy .env to the server and configure your production values"
    exit 1
fi

# Generate APP_KEY if needed
echo "[1/6] Checking APP_KEY..."
if ! grep -q "base64:" .env | head -1; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
else
    echo "APP_KEY already set"
fi

# Install/update dependencies
echo ""
echo "[2/6] Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Run database migrations
echo ""
echo "[3/6] Running database migrations..."
php artisan migrate --force --no-interaction

# Seed database if needed
echo ""
echo "[4/6] Seeding database..."
php artisan db:seed --force --no-interaction || true

# Create storage link
echo ""
echo "[5/6] Creating storage link..."
php artisan storage:link --force || true

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
echo "  Deployment Complete!"
echo "========================================"
