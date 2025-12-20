# Base image: PHP 8.2 with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite (commonly needed for PHP frameworks)
RUN a2enmod rewrite && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy application source
COPY . .

# Optionally install Composer and dependencies if composer.json exists
RUN if [ -f composer.json ]; then set -eux; \
    apt-get update && apt-get install -y git unzip curl && rm -rf /var/lib/apt/lists/*; \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --prefer-dist --no-progress --no-interaction; \
  fi

# Expose HTTP port
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]