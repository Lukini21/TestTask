#!/bin/sh
set -e

composer setup

chmod -R 777 /var/www/storage
chmod -R 777 /var/www/bootstrap/cache

exec "$@"
