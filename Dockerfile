FROM php:8.1-apache

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    apt-transport-https \
    ca-certificates \
    gnupg


RUN echo "deb http://deb.debian.org/debian buster main contrib non-free" > /etc/apt/sources.list.d/debian.list && \
    apt-get update && \
    apt-get install -y sox


RUN apt-get update && apt-get install -y git \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    unzip \
    imagemagick \
    libmagickwand-dev \
    && docker-php-ext-install intl pdo_mysql zip opcache gd && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

RUN pecl install xdebug-3.1.1 && docker-php-ext-enable xdebug

RUN pecl install imagick && docker-php-ext-enable imagick

RUN apt-get install nano

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN apt-get update && apt-get install -y cron \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" > /etc/cron.d/cron-laravel-schedule

RUN chmod 0644 /etc/cron.d/cron-laravel-schedule \
    && crontab /etc/cron.d/cron-laravel-schedule

RUN chown -R www-data:www-data /var/www/html && a2enmod rewrite

CMD service cron start && apache2-foreground
