FROM php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apk update && apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    freetype-dev \
    libpng-dev \
    jpegoptim-bin \
    pngquant-bin

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    tokenizer \
    xml \
    ctype \
    json \
    zip \
    intl \
    gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . /var/www/html

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create storage link
RUN php artisan storage:link

# Set file permissions (adjust as needed)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/bootstrap/cache /var/www/html/storage

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
