FROM php:7.4-fpm-buster

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -

#RUN echo 'Acquire::ForceIPv4 "true";' > /etc/apt/apt.conf.d/99force-ipv4

RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client \
    git \
    gettext \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmongoc-1.0-0 libmongoc-dev \
    libpng-dev \
    libonig-dev libzip-dev \
    redis-tools \
    locales \
    nano \
    nodejs \
    libxml2-dev \
    sqlite3 libsqlite3-dev \
    wget \
    zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/* && \
    npm install -g yarn

RUN docker-php-ext-install gd pdo_mysql mbstring zip exif pcntl fileinfo soap gettext pdo_sqlite

WORKDIR /tmp

# Install PHP Redis
RUN curl -o phpredis-5.1.1.tgz https://pecl.php.net/get/redis-5.1.1.tgz && \
    tar xfz phpredis-5.1.1.tgz && cd redis-5.1.1 && \
    phpize && ./configure && make && make install

# Install MongoDB PHP Driver
RUN curl -o mongodb-1.7.2.tgz https://pecl.php.net/get/mongodb-1.7.2.tgz && \
    tar xfz mongodb-1.7.2.tgz && cd mongodb-1.7.2 && \
    phpize && ./configure && make && make install

# Install XDebug
RUN curl -o xdebug-2.9.1.tgz https://pecl.php.net/get/xdebug-2.9.1.tgz && \
    tar xfz xdebug-2.9.1.tgz && cd xdebug-2.9.1 && \
    phpize && ./configure && make && make install

RUN docker-php-ext-enable redis mongodb xdebug

RUN echo 'memory_limit=2048M' >> /usr/local/etc/php/php.ini && \
    echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini && \
    echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini && \
    echo 'xdebug.remote_connect_back=0' >> /usr/local/etc/php/php.ini && \
    echo 'xdebug.var_display_max_depth=' >> /usr/local/etc/php/php.ini && \
    echo 'xdebug.remote_host=${HOST_IP}' >> /usr/local/etc/php/php.ini && \
    curl -o /usr/lib/ssl/curl-cacert.pem https://curl.haxx.se/ca/cacert.pem && \
    echo "curl.cainfo = '/usr/lib/ssl/curl-cacert.pem'" >> /usr/local/etc/php/php.ini

RUN echo "php_flag[display_errors] = On">>/usr/local/etc/php-fpm.conf && \
    echo "php_admin_flag[log_errors] = On">>/usr/local/etc/php-fpm.conf && \
    echo "php_admin_value[display_errors] = 'stderr'">>/usr/local/etc/php-fpm.conf

RUN echo "en_US.UTF-8 UTF-8" >> /etc/locale.gen && \
echo "en_GB.UTF-8 UTF-8" >> /etc/locale.gen && \
echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen && \
echo "it_IT.UTF-8 UTF-8" >> /etc/locale.gen && \
echo "nl_NL.UTF-8 UTF-8" >> /etc/locale.gen && \
echo "de_DE.UTF-8 UTF-8" >> /etc/locale.gen && \
echo "es_ES.UTF-8 UTF-8" >> /etc/locale.gen && locale-gen

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 1000 www-data && \
    groupmod -g 1000 www-data && \
    chown -R www-data:www-data /var/www

USER www-data

ENV XDG_CONFIG_HOME "/var/www"
ENV COMPOSER_HOME "/var/www/.composer"

RUN composer global require bamarni/composer-bin-plugin && \
    composer global bin phpcs require squizlabs/php_codesniffer && \
    composer global bin php-cs-fixer require friendsofphp/php-cs-fixer && \
    composer global bin phpmd require phpmd/phpmd && \
    composer global bin phpmnd require povils/phpmnd && \
    composer global bin dephpend require dephpend/dephpend:dev-main && \
    composer global bin phploc require phploc/phploc && \
    composer global bin phpcpd require sebastian/phpcpd && \
    composer global bin churn require bmitch/churn-php && \
    composer global bin php-code-fixer require wapmorgan/php-code-fixer:dev-master && \
    composer global bin phpmetrics require phpmetrics/phpmetrics && \
    composer global bin security-checker require sensiolabs/security-checker


ENV PATH="/var/www/.composer/vendor/bin:${PATH}"

WORKDIR /var/www/html
