FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY apache.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

WORKDIR /var/www/html

CMD ["apache2-foreground"]
