FROM php:7.2.0-fpm
RUN apt-get update && apt-get install -y mysql-client -y libzip-dev zip --no-install-recommends \
 && docker-php-ext-configure zip --with-libzip \
 && docker-php-ext-install sockets zip pdo_mysql bcmath mbstring

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000
