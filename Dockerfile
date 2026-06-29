FROM php:8.2-cli

RUN docker-php-ext-install pdo_pgsql pgsql

WORKDIR /app

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
