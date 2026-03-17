FROM dunglas/frankenphp:1-php8.4 AS base

RUN install-php-extensions \
    bcmath \
    exif \
    gd \
    intl \
    opcache \
    pcntl \
    pdo_pgsql \
    pgsql \
    xml \
    zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

FROM base AS dev

COPY docker/frankenphp/Caddyfile /etc/caddy/Caddyfile
COPY docker/frankenphp/start-container.sh /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

CMD ["start-container"]

FROM base AS production

COPY . /app
COPY docker/frankenphp/Caddyfile /etc/caddy/Caddyfile

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]
