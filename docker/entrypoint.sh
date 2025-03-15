#!/bin/sh
cd /app
composer install --no-interaction --ignore-platform-reqs --verbose

php /app/artisan optimize:clear
php /app/artisan optimize

# chmod 775 -R /app/storage/logs /app/storage/framework

php-fpm