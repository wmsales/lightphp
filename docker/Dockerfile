FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80

RUN a2enmod rewrite

ARG APP_ENV=production
ENV APP_ENV $APP_ENV

RUN if [ "$APP_ENV" = "development" ]; then composer install --prefer-dist --no-interaction; else composer install --no-dev --optimize-autoloader; fi
