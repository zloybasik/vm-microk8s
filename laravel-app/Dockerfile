FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y nginx libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Если .env отсутствует — создаём его
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Установка зависимостей Laravel
RUN composer install --no-dev --optimize-autoloader

# Генерация ключа приложения
RUN php artisan key:generate

# Права на storage и bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Копируем nginx конфиг
COPY ./k8s/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

CMD service nginx start && php-fpm
