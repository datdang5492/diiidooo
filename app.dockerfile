FROM php:7.2.0-fpm
RUN apt-get update && apt-get install -y mysql-client --no-install-recommends \
 && docker-php-ext-install pdo_mysql
