FROM composer:2.5.7

WORKDIR /app

# Install necessary packages
RUN apk add --no-cache \
    nginx \
    php \
    php-fpm \
    php-opcache \
    php-curl \
    php-mbstring \
    php-zip \
    php-xml \
    php-mysqli \
    php-pdo \
    php-pdo_mysql \
    # php-pecl-redis \
    php-tokenizer \
    php-fileinfo \
    php-json \
    php-phar \
    curl-dev \
    oniguruma-dev \
    libzip-dev \
    libxml2-dev

# Install PHP extensions
RUN docker-php-ext-install bcmath curl mbstring zip xml
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
# RUN docker-php-ext-install bcmath libcurl curl  mbstring zip xml pdo pdo_mysql

# Copy application files
COPY . .

# Expose port 8000
EXPOSE 8000

# Copy Nginx configuration
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/laravel-app/sites-available/default /etc/nginx/conf.d/default.conf

# Copy PHP-FPM configuration
COPY ./docker/php/php-fpm.conf /etc/php8/php-fpm.conf

# Start Nginx and PHP-FPM
CMD ["sh", "-c", "php artisan migrate && php-fpm && nginx -g 'daemon off;'"]
