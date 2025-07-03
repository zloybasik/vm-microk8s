FROM php:8.2-fpm

# Установка системных зависимостей и расширений PHP для PostgreSQL и Laravel
RUN apt-get update && apt-get install -y \
        nginx \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        git \
        curl \
        libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

# Если .env отсутствует — создаём его
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Установка зависимостей Laravel без dev-пакетов и с оптимизацией автозагрузчика
RUN composer install --no-dev --optimize-autoloader

# Генерация ключа приложения
RUN php artisan key:generate

# Установка прав на storage, bootstrap/cache и database (если используется)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/database

# Копируем конфигурацию nginx
COPY ./k8s/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

# Запуск nginx и php-fpm, а также выполнение миграций при старте контейнера
CMD service nginx start && php artisan migrate --force && php-fpm
