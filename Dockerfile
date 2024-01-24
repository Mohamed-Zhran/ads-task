FROM php:8.3.0-fpm

# Set working directory
WORKDIR /var/www

# Copy composer.lock and composer.json
COPY src/composer.lock src/composer.json /var/www/

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libmagickwand-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libicu-dev \
    npm \
    nodejs \
    iputils-ping \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-png
RUN docker-php-ext-configure intl && \
    docker-php-ext-install pdo_mysql pdo zip exif pcntl intl gd

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents and set permissions
COPY --chown=www:www ./src/ /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
