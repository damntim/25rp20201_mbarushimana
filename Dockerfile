# Dockerfile (Phase 5: Containerization)
# Base image: PHP 8.1 with Apache
FROM php:8.1-apache

# Set working directory inside the container
WORKDIR /var/www/html

# Copy application files into the container
# Includes index.php, api.php, Patient.php, config.php, data/patients.json, etc.
COPY . .

# FIX: Disable conflicting MPMs and enable prefork (fixes Railway crash)
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# Enable Apache mod_rewrite (commonly needed for PHP routing)
RUN a2enmod rewrite

# Ensure data directory exists in the image even if local data/ is ignored
RUN mkdir -p /var/www/html/data \
    && chown -R www-data:www-data /var/www/html/data

# Install curl for HEALTHCHECK
RUN apt-get update && apt-get install -y curl && rm -rf /var/lib/apt/lists/*

# Configure Apache to listen on Railway's dynamic PORT
RUN sed -i 's/Listen 80/Listen ${PORT:-80}/' /etc/apache2/ports.conf

# Update VirtualHost to use PORT variable
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT:-80}>/' /etc/apache2/sites-available/000-default.conf

# Add a healthcheck to verify the web server responds
HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
  CMD curl -fsS http://localhost:${PORT:-80}/ || exit 1

# Expose HTTP port (Railway will override with $PORT env var)
EXPOSE 80

# Create startup script to handle Railway's PORT environment variable
RUN echo '#!/bin/bash\n\
export APACHE_PORT=${PORT:-80}\n\
echo "Starting Apache on port $APACHE_PORT"\n\
sed -i "s/Listen 80/Listen $APACHE_PORT/" /etc/apache2/ports.conf 2>/dev/null || true\n\
sed -i "s/<VirtualHost \\*:80>/<VirtualHost *:$APACHE_PORT>/" /etc/apache2/sites-available/000-default.conf 2>/dev/null || true\n\
apache2-foreground' > /usr/local/bin/start-apache.sh \
    && chmod +x /usr/local/bin/start-apache.sh

# Start Apache with custom script
CMD ["/usr/local/bin/start-apache.sh"]