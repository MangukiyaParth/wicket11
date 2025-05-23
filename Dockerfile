FROM php:8.2-apache

# Install dependencies for Composer + zip extension
RUN apt-get update && apt-get install -y \
    unzip zip libzip-dev \
    && docker-php-ext-install zip mysqli

# Enable Apache modules
RUN a2enmod rewrite headers

# Allow .htaccess overrides
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Make Apache listen on Cloud Run port
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf && \
    sed -i 's/:80>/:${PORT}>/' /etc/apache2/sites-available/000-default.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Now copy the rest of the app
COPY . .

EXPOSE 8080
CMD ["apache2-foreground"]
