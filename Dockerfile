# ----------------------------------------
# 1️⃣ Composer stage — install PHP deps
# ----------------------------------------
FROM composer:2 AS composer_build

WORKDIR /app

# Copy only composer files first for layer caching
COPY composer.json composer.lock ./

# Install PHP dependencies without dev tools
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of your Laravel project
COPY . .

# Generate Ziggy routes (optional: publish assets)
# If you use Ziggy's Vite plugin, this may not be needed.
# But if you rely on the vendor file, ensure it's here.

# ----------------------------------------
# 2️⃣ Node stage — build frontend assets
# ----------------------------------------
FROM node:20-alpine AS node_build

WORKDIR /app

# Copy only Node/Vite related files
COPY package*.json ./
COPY vite.config.js ./
COPY tailwind.config.js ./
COPY resources/ ./resources/

# ✅ Copy Ziggy's vendor files from Composer stage
COPY --from=composer_build /app/vendor ./vendor

# Install Node dependencies & build Vite assets
RUN npm ci && npm run build

# ----------------------------------------
# 3️⃣ Final image — PHP-FPM + NGINX + Supervisor
# ----------------------------------------
FROM php:8.3-fpm-alpine

# Install OS packages
RUN apk add --no-cache \
    nginx \
    bash \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    shadow \
    su-exec \
    supervisor

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip intl opcache bcmath gd

# Set working directory
WORKDIR /var/www/html

# Copy built backend & vendor files
COPY --from=composer_build /app ./

# Copy built frontend assets (Vite output)
COPY --from=node_build /app/public ./public

# Add nginx config
COPY ./docker/nginx.conf /etc/nginx/nginx.conf

# Add supervisor config
COPY ./docker/supervisord.conf /etc/supervisord.conf

# Fix permissions for Laravel
RUN addgroup -g 1000 www && \
    adduser -G www -u 1000 -D www && \
    chown -R www:www /var/www/html && \
    chmod -R 755 /var/www/html/storage

# Expose HTTP port
EXPOSE 80

# Run NGINX + PHP-FPM with Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
