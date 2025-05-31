FROM php:8.2-cli

# Instalar extensiones necesarias de PHP
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libxml2-dev \
    default-mysql-client \
    #Dado que no funciona GUI de la base de datos, tengo que interacturar con la base de datos desde la termianal
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif opcache
    #exif es para que funcione la libreria de imagenes de laravel

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
