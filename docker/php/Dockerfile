FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y git unzip libicu-dev libzip-dev \
    && docker-php-ext-install pdo_mysql intl zip \
    && a2enmod rewrite

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
