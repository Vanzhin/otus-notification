FROM php:8.3-fpm
MAINTAINER Nikolay Vanzhin <vanzhin@outlook.com>
# задаются переменные
ARG work_dir=/var/www
ENV PORT=8000
ENV PUBLIC_DIR=$work_dir/app/public
ENV INDEX_FILE=index.php

# выполняется установка утилит и расширений
# выполняется установка утилит и расширений
RUN apt-get update && apt-get install --no-install-recommends --no-install-suggests -y \
		git \
        curl \
        htop \
        libpq-dev \
        unzip \
        libzip-dev \
        librabbitmq-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
        opcache \
        zip \
        pdo \
        pdo_pgsql \
    && pecl install \
        amqp \
    && docker-php-ext-enable \
        amqp

# копируется файл для php
COPY php.ini /usr/local/etc/php/php.ini
#копируется код для фреймворка
WORKDIR $work_dir
COPY app app
COPY --from=composer:2.7.2 /usr/bin/composer /usr/bin/composer
# указывается внутренний порт
EXPOSE $PORT
#копируется файл, который будет выполняться при старте контейнера, а не при билде.
COPY entrypoint.sh /app/entrypoint.sh
RUN chmod +x /app/entrypoint.sh
ENTRYPOINT ["/app/entrypoint.sh"]