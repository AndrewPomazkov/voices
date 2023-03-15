FROM php:8.1-apache

RUN apt-get update && apt-get install -y git \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    && docker-php-ext-install intl pdo_mysql zip opcache gd

RUN pecl install xdebug-3.1.1 && docker-php-ext-enable xdebug

RUN a2enmod rewrite

WORKDIR /var/www/html

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN apt-get install nano
