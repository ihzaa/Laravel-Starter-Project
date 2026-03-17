#!/usr/bin/env sh
set -eu

cd /app

if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
fi

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist
fi

exec frankenphp run --config /etc/caddy/Caddyfile --adapter caddyfile
