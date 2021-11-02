FROM php:8-fpm

RUN apt-get update && apt-get install -y curl \ 
    vim \
    libpq-dev \
    libxml2-dev \
    openssl \
    git 

RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip

RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    bcmath \
    soap 

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

WORKDIR /opt/prescriptions-api/src

EXPOSE 8000 80