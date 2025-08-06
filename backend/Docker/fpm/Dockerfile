FROM php:8.2-fpm

WORKDIR /api

RUN apt-get update && apt-get install -y \
    zip unzip curl sqlite3 libsqlite3-dev libzip-dev \
    && docker-php-ext-install pdo pdo_sqlite zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer