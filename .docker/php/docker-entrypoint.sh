#!/bin/sh
set -e

composer setup
php artisan key:generate --force
php artisan migrate --force
php artisan db:seed
php artisan optimize:clear

chmod -R 777 /var/www/storage
chmod -R 777 /var/www/bootstrap/cache

exec "$@"
