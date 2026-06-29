FROM php:8.2-cli

RUN apt-get update && apt-get install -y --no-install-recommends libpq-dev unzip \
    && docker-php-ext-install pdo_pgsql pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /app

COPY . .

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_NO_SCRIPTS=1
RUN cp .env.example .env \
    && sed -i 's|DB_CONNECTION=sqlite|DB_CONNECTION=pgsql|' .env \
    && sed -i 's|APP_ENV=local|APP_ENV=production|' .env \
    && sed -i 's|APP_URL=http://localhost|APP_URL=https://geeta-arts.onrender.com|' .env \
    && sed -i 's|SESSION_DRIVER=database|SESSION_DRIVER=file|' .env \
    && sed -i 's|QUEUE_CONNECTION=database|QUEUE_CONNECTION=sync|' .env \
    && sed -i 's|CACHE_STORE=database|CACHE_STORE=file|' .env \
    && sed -i '/^APP_KEY=/d' .env \
    && APP_KEY=$(php -r 'echo "base64:" . base64_encode(random_bytes(32));') \
    && echo "APP_KEY=$APP_KEY" >> .env
RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD sed -i '/^DB_HOST=/d; /^DB_DATABASE=/d; /^DB_USERNAME=/d; /^DB_PASSWORD=/d; /^DB_PORT=/d; /^APP_URL=/d; /^ASSET_URL=/d' .env && \
    echo "APP_URL=https://geeta-arts.onrender.com" >> .env && \
    echo "ASSET_URL=https://geeta-arts.onrender.com" >> .env && \
    echo "DB_HOST=$DB_HOST" >> .env && \
    echo "DB_DATABASE=$DB_DATABASE" >> .env && \
    echo "DB_USERNAME=$DB_USERNAME" >> .env && \
    echo "DB_PASSWORD=$DB_PASSWORD" >> .env && \
    echo "DB_PORT=$DB_PORT" >> .env && \
    php artisan migrate --force 2>&1 && \
    php artisan db:seed --force --class='Database\Seeders\PageContentSeeder' 2>&1 && \
    php artisan serve --host=0.0.0.0 --port=$PORT
