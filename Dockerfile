FROM php:8.2-fpm

# Installer les dépendances système et extensions PHP requises
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer depuis le conteneur officiel Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Définir un répertoire de travail où l'application sera installée
WORKDIR /var/www

# Copier les fichiers du projet Laravel
COPY . .

# Installer les dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate

# Exposer le port utilisé par Laravel (serveur intégré)
EXPOSE 8000

# Lancer Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
