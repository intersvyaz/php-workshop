FROM php:7.2-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    LANG="ru_RU.UTF-8"

RUN docker-php-ext-install pdo_mysql mysqli && \
    apt-get -y update && apt-get install -y apache2-utils dnsutils git unzip locales && \
    echo "ru_RU.UTF-8 UTF-8" >> /etc/locale.gen && locale-gen && \
    pecl install xdebug && \
    curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --quiet

COPY entrypoint /usr/local/bin
RUN chmod +x /usr/local/bin/entrypoint

WORKDIR /var/www

ENTRYPOINT ["entrypoint"]
CMD ["php-fpm", "-R"]
