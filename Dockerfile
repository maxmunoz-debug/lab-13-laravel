# Usar la imagen oficial de PHP con Apache
FROM php:8.3-apache

# Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias para Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Activar el módulo rewrite de Apache (necesario para las rutas de Laravel)
RUN a2enmod rewrite

# Configurar el directorio raíz de Apache al directorio public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto al contenedor
COPY . .

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Crear la carpeta de imágenes si no existe y dar permisos necesarios a las carpetas de Laravel
RUN mkdir -p /var/www/html/public/img/fotos \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/img/fotos

# Exponer el puerto 80
EXPOSE 80

# Comando para crear la base de datos SQLite, migrar, sembrar los datos y arrancar Apache
CMD touch database/database.sqlite && php artisan migrate --force && php artisan db:seed --force && apache2-foreground
