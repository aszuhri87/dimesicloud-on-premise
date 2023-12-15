FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libonig-dev \
    libpq-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales


# Set working directory
WORKDIR /app


# Install php extensions
RUN docker-php-ext-install mbstring pdo_pgsql pgsql zip exif pcntl gd

# Install composer
COPY --from=composer:2.4.4 /usr/bin/composer /usr/bin/composer

COPY . /app

RUN composer install --optimize-autoloader --no-dev

RUN php artisan route:clear && php artisan config:clear && php artisan cache:clear && php artisan optimize:clear

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
