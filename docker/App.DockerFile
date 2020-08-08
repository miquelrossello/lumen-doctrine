FROM php:7.4-apache

# Update & Upgrate
RUN apt update -y && apt upgrade -y

RUN apt-get install apt-utils libcurl4-openssl-dev libzip-dev libxml2-dev libpng-dev unzip -y

# Install required extensions
RUN docker-php-ext-install pdo_mysql curl zip gd

RUN a2enmod rewrite

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/lumen_doctrine
