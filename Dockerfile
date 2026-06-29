FROM php:8.2-cli

RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev unzip \
    && docker-php-ext-install pdo_pgsql pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_NO_SCRIPTS=1
RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD APP_KEY=$(php -r 'echo "base64:" . base64_encode(random_bytes(32));') && \
    export APP_KEY && \
    php artisan migrate --force 2>&1 && \
    php artisan db:seed --force --class='Database\Seeders\PageContentSeeder' 2>&1 && \
    php artisan serve --host=0.0.0.0 --port=$PORT
