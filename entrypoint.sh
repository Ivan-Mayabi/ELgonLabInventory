#!/bin/bash

# Wait for MySQL to connect
sleep 5

# Run database migrations automatically
php artisan migrate --force

# Start Apache in the foreground (keeps container running)
exec apache2-foreground

# chmod +x entrypoint.sh