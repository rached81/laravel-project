# Utiliser l'image de base PHP 8.2 avec FPM
FROM php:8.2-fpm

# Installer les extensions nécessaires, y compris pdo_mysql et git
RUN apt-get update && apt-get install -y \
    git \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Donner les permissions au dossier
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Installer les dépendances Composer lors de la construction
COPY ./src/composer.json /var/www/html/composer.json
RUN composer install --no-scripts --no-autoloader

# Copie les fichiers de l'application
COPY ./src /var/www/html

# Exécuter Composer pour charger les classes
RUN composer dump-autoload
