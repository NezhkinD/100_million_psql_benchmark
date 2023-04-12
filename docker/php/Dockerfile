FROM php:8.2.3-fpm-buster
# FROM php:7.4.33-fpm-buster

WORKDIR /

###> Install dependencies ###
RUN apt-get update && apt-get install -y \
    zip \
    vim \
    unzip \
    git \
    nano \
    wget \
    make
###< Install dependencies ###

###> Install curl v7.80.0 https://yannmjl.medium.com/how-to-manually-update-curl-on-ubuntu-server-899476062ad6 ###
RUN apt-get update && apt-get install -y libssl-dev autoconf libtool make
WORKDIR /usr/local/src
RUN rm -rf curl*
RUN wget https://curl.haxx.se/download/curl-7.80.0.zip
RUN unzip curl-7.80.0.zip
WORKDIR /curl-7.80.0
CMD ["./buildconf"]
CMD ["./configure","--with-ssl"]
CMD ["make"]
CMD ["make", "install"]
###< Install curl v7.80.0 ###

###> Install composer ###
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
###< Install composer ###

###> Запускаем файл install-php-extensions и устанавливаем php-extension amqp  https://github.com/mlocati/docker-php-extension-installer ###
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions amqp ssh2 imap redis pdo_pgsql xdebug yaml mailparse

WORKDIR /home/app

EXPOSE 9000
CMD ["php-fpm"]