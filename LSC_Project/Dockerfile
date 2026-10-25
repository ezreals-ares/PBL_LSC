# =============================================================================
# Stage 1: Node.js - Build frontend assets
# =============================================================================
FROM node:22-alpine AS node-builder

WORKDIR /app

# Copy package files first for layer caching
COPY package.json package-lock.json ./

# Install ALL dependencies (dev + prod) needed for build
RUN npm ci

# Copy source files needed for Vite build
COPY resources/ ./resources/
COPY vite.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js* ./
COPY public/ ./public/

# Build production assets
RUN npm run build

# =============================================================================
# Stage 2: PHP Composer - Install PHP dependencies
# =============================================================================
FROM php:8.5-fpm-alpine AS composer-builder

# Install system dependencies & PHP extensions required by Laravel
RUN apk add --no-cache \
        git \
        curl \
        unzip \
        libpng-dev \
        libjpeg-turbo-dev \
        libwebp-dev \
        freetype-dev \
        libzip-dev \
        icu-dev \
        oniguruma-dev \
        postgresql-dev \
        linux-headers \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        pgsql \
        pdo_mysql \
        gd \
        zip \
        intl \
        mbstring \
        exif \
        bcmath \
        opcache \
        pcntl \
        sockets

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first for layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies (no dev, optimized autoloader)
RUN composer install \
        --no-dev \
        --no-interaction \
        --prefer-dist \
        --optimize-autoloader \
        --no-scripts

# Copy the rest of the application
COPY . .

# Run composer update to ensure everything is up to date, then re-dump autoload
RUN composer dump-autoload --optimize --no-dev

# =============================================================================
# Stage 3: Production image
# =============================================================================
FROM php:8.5-fpm-alpine AS production

LABEL maintainer="LSC Project"
LABEL description="Laravel 12 + Filament 4 + PostgreSQL"
LABEL php.version="8.5"
LABEL node.version="22"

# Install runtime system dependencies
RUN apk add --no-cache \
        nginx \
        supervisor \
        curl \
        libpng \
        libjpeg-turbo \
        libwebp \
        freetype \
        libzip \
        icu \
        oniguruma \
        postgresql-libs \
        linux-headers \
    && apk add --no-cache --virtual .build-deps \
        libpng-dev \
        libjpeg-turbo-dev \
        libwebp-dev \
        freetype-dev \
        libzip-dev \
        icu-dev \
        oniguruma-dev \
        postgresql-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_pgsql \
        pgsql \
        pdo_mysql \
        gd \
        zip \
        intl \
        mbstring \
        exif \
        bcmath \
        opcache \
        pcntl \
        sockets \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# PHP OPcache configuration for production
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.save_comments=1" >> /usr/local/etc/php/conf.d/opcache.ini

# PHP upload and memory limits
RUN echo "upload_max_filesize=64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=64M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time=120" >> /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www/html

# Copy application from composer-builder stage
COPY --from=composer-builder --chown=www-data:www-data /app /var/www/html

# Copy built frontend assets from node-builder stage
COPY --from=node-builder --chown=www-data:www-data /app/public/build /var/www/html/public/build

# Copy Docker configuration files
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache \
    && mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/storage/framework/{sessions,views,cache} \
    && chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
