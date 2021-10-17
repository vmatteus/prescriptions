FROM php:7.4-fpm

RUN apt-get update && apt-get install -y curl \ 
    vim \
    libpq-dev \
    libxml2-dev \
    openssl \
    git


RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    bcmath \
    soap 

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

WORKDIR /opt/base-api

EXPOSE 8000 80