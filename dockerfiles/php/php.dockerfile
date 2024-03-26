FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN docker-php-ext-install pdo_mysql

RUN chown -R www-data:www-data .
RUN chmod -R 775 .

