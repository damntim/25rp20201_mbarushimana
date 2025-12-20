# Dockerfile (Phase 5: Containerization)
# Base image: PHP 8.1 with Apache
FROM php:8.1-apache

# Set working directory inside the container
WORKDIR /var/www/html

# Copy application files into the container
# Includes index.php, api.php, Patient.php, config.php, data/patients.json, etc.
COPY . .

# Enable Apache mod_rewrite (commonly needed for PHP routing)
RUN a2enmod rewrite

# Ensure data directory exists in the image even if local data/ is ignored
RUN mkdir -p /var/www/html/data \
    && chown -R www-data:www-data /var/www/html/data

# Optional: install curl for HEALTHCHECK
RUN apt-get update && apt-get install -y curl && rm -rf /var/lib/apt/lists/*

# Add a healthcheck to verify the web server responds
HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
  CMD curl -fsS http://localhost/ || exit 1

# Expose HTTP port
EXPOSE 80

# No CMD needed; php:8.1-apache starts Apache by default