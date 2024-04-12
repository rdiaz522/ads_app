FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

RUN apk update

RUN docker-php-ext-install pdo_mysql

# Add xdebug
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN apk add --update linux-headers
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN apk del -f .build-deps


RUN chown -R www-data:www-data .
RUN chmod -R 775 .

