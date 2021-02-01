FROM php:7.3-fpm

COPY ./php/php.ini /usr/local/etc/php/php.ini

COPY ./laravel/composer.json /var/www/

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libonig-dev \
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
    mc \
    wget

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql zip exif pcntl \
    && docker-php-ext-install gd \
    && docker-php-ext-install bcmath


RUN pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.10.19


# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY ./laravel /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

