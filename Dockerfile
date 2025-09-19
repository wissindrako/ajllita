FROM php:7.4-fpm

# Arguments
ARG user
ARG uid

# Instala dependencias para GD (freetype, jpeg y png)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libfreetype6-dev \    # <-- Añade esta línea
    libjpeg62-turbo-dev \ # <-- Añade esta línea
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpia cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configura GD antes de instalarlo
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
