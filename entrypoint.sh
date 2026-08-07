#!/bin/bash

# Change the permissions of the necessary folders
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs
chown -R www-data:www-data storage bootstrap/cache
chmod -R 777 storage bootstrap/cache

# Wait for MySQL to connect
sleep 5

# Clear the config and optimize
php artisan config:clear
php artisan view:clear
php artisan optimize:clear

# Run database migrations automatically
php artisan migrate --force

# Start Apache in the foreground (keeps container running)
exec apache2-foreground

# chmod +x entrypoint.sh
