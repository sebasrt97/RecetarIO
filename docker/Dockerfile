FROM php:8.2-fpm

# Instalar dependencias del sistema para PHP
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libxml2-dev \
    default-mysql-client && \
    # libzip-dev        # Dependencia de desarrollo para la extensión 'zip' de PHP.
    #libonig-dev     # Dependencia de desarrollo para la extensión 'mbstring' de PHP (expresiones regulares).
    #libpng-dev        # Dependencia de desarrollo para soportar imágenes PNG en la extensión GD.
    #libjpeg-dev        # Dependencia de desarrollo para soportar imágenes JPEG en la extensión GD.
    #libwebp-dev        # Dependencia de desarrollo para soportar imágenes WebP en la extensión GD.
    #libfreetype6-dev   # Dependencia de desarrollo para soportar fuentes TrueType en la extensión GD.
    #libxml2-dev       # Dependencia de desarrollo para la extensión 'xml' de PHP (parsing XML).
    # Limpiar caché de apt después de la instalación para reducir el tamaño final de la imagen Docker.
    rm -rf /var/lib/apt/lists/*

# Instalar las extensiones de PHP utilizando docker-php-ext-install
RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    opcache \
    fileinfo

        #pdo \           # PHP Data Objects: Interfaz para acceder a bases de datos.
        #pdo_mysql \     # Controlador PDO específico para MySQL (necesario para Laravel con MySQL).
        #mbstring \      # Multi-Byte String: Funciones para manejar cadenas de texto con caracteres multibyte (UTF-8).
        #zip \           # Extensión para crear y manipular archivos ZIP.
        #exif \          # Permite leer datos EXIF de imágenes (metadatos como fecha, cámara, etc.).
        #opcache \       # Mejora el rendimiento de PHP almacenando el bytecode precompilado en memoria.
        #fileinfo \      # Detecta el tipo de contenido y codificación de un archivo (útil para mime_content_type()).

# Configurar e instalar la extensión GD
RUN docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp && \
    docker-php-ext-install -j$(nproc) gd

# Instalar Composer

# Copiar el ejecutable de Composer desde una imagen oficial de Composer.
# composer:latest: Una imagen Docker oficial que solo contiene el ejecutable de Composer.
# /usr/bin/composer: Es la ruta de destino donde se copiará Composer en tu imagen.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define el directorio de trabajo predeterminado para cualquier instrucción posterior.
# Aquí es donde se espera que esté el código de tu aplicación Laravel.
WORKDIR /var/www/html

# Define el comando que se ejecutará cuando el contenedor se inicie.
# php artisan serve: Inicia el servidor de desarrollo de Laravel.
# --host=0.0.0.0: Permite que la aplicación sea accesible desde fuera del contenedor.
# --port=8000: Define el puerto en el que la aplicación Laravel escuchará.
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]