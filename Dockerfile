# --- Etapa 1: Compilar recursos del Frontend (Bootstrap, CSS, JS) ---
FROM node:20 AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Etapa 2: Servidor PHP Apache de Producción ---
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

# Copiar los recursos compilados (Vite assets) desde la Etapa 1
COPY --from=frontend-builder /app/public/build /var/www/html/public/build

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Crear directorios y base de datos SQLite con los permisos de usuario www-data correctos
RUN mkdir -p /var/www/html/database /var/www/html/public/img/fotos \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public/img/fotos /var/www/html/database

# Exponer el puerto 80
EXPOSE 80

# Ejecutar las migraciones y sembrar como usuario www-data para evitar conflictos de permisos, luego iniciar Apache
CMD su -s /bin/bash -c "php artisan migrate --force && php artisan db:seed --force" www-data && apache2-foreground
