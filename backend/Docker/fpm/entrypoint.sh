#!/bin/sh

echo "Running entrypoint.sh..."

composer install --no-interaction --prefer-dist --optimize-autoloader

php artisan config:clear
php artisan config:cache
php artisan key:generate

php artisan migrate --force

echo "Initialization complete. Running main process..."
exec "$@"
