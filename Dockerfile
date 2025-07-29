# ----------------------------------------
# 1️⃣ Composer + PHP build (use same PHP)
# ----------------------------------------
FROM php:8.3-fpm-alpine AS composer_build

# Install Composer & extensions
RUN apk add --no-cache \
    curl \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    unzip \
    bash \
    git

# Install PHP extensions
RUN docker-php-ext-install intl zip mbstring pdo pdo_mysql

# Install Composer manually
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader


# ----------------------------------------
# 2️⃣ Node build
# ----------------------------------------
FROM node:20-alpine AS node_build

WORKDIR /app

COPY package*.json ./
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY resources/ ./resources/

# Copy vendor for Ziggy
COPY --from=composer_build /app/vendor ./vendor

RUN npm ci && npm run build

# ----------------------------------------
# 3️⃣ Final image
# ----------------------------------------
FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    nginx \
    bash \
    curl \
    icu-dev \
    libzip-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    shadow \
    su-exec \
    supervisor

RUN docker-php-ext-install intl zip mbstring pdo pdo_mysql bcmath gd opcache

WORKDIR /var/www/html

COPY --from=composer_build /app ./
COPY --from=node_build /app/public ./public

COPY ./docker/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf

RUN addgroup -g 1000 www && \
    adduser -G www -u 1000 -D www && \
    chown -R www:www /var/www/html && \
    chmod -R 755 /var/www/html/storage

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
