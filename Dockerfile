# ----------------------------------------
# 1️⃣ Build the frontend assets (Node)
# ----------------------------------------
FROM node:20-alpine AS node_builder

WORKDIR /app

# Copy only the files needed to install dependencies
COPY package*.json ./
COPY vite.config.js ./
COPY resources/ ./resources/
COPY tailwind.config.js ./

# Install and build frontend assets
RUN npm ci && npm run build

# ----------------------------------------
# 2️⃣ Build PHP app (Composer, Laravel)
# ----------------------------------------
FROM composer:2 AS php_builder

WORKDIR /app

# Copy composer files & install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the app source
COPY . .

# ----------------------------------------
# 3️⃣ Final image (Nginx + PHP-FPM)
# ----------------------------------------
FROM php:8.3-fpm-alpine

# Install system dependencies
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

# Copy Laravel app from builder
WORKDIR /var/www/html
COPY --from=php_builder /app ./

# Copy built frontend assets
COPY --from=node_builder /app/public ./public

# Add default nginx config
COPY ./docker/nginx.conf /etc/nginx/nginx.conf

# Fix permissions
RUN addgroup -g 1000 www && \
    adduser -G www -u 1000 -D www && \
    chown -R www:www /var/www/html && \
    chmod -R 755 /var/www/html/storage

# Copy supervisord config
COPY ./docker/supervisord.conf /etc/supervisord.conf

# Expose HTTP
EXPOSE 80

# Start all services (nginx + php-fpm)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
