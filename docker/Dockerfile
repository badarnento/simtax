FROM php:8.3-fpm-alpine

# Install dependencies
RUN apk add --no-cache \
    bash \
    zip \
    unzip \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    oniguruma-dev \
    icu-dev \
    libzip-dev \
    mysql-client \
    postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd mbstring pdo pdo_mysql pdo_pgsql zip intl opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the PHP-FPM configuration file
COPY ./docker/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# Set working directory
WORKDIR /app

# Copy Laravel app
COPY ./ /app
RUN addgroup -S nginx && adduser -S simtax nginx

RUN chown -R simtax:nginx /app
RUN chmod -R 775 /app
# Set permissions
RUN mkdir -p /var/run/php && chown -R simtax:nginx /var/run/php
RUN mkdir -p /app/storage /app/bootstrap/cache \
    && chown -R www-data:www-data /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

COPY ./docker/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# CMD ["php-fpm"]
ENTRYPOINT ["entrypoint.sh"]