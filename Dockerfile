
# Dockerfile - PHP + Apache with Postgres PDO support
FROM php:8.1-apache

# Install dependencies for PostgreSQL PDO
RUN apt-get update \
  && apt-get install -y libpq-dev \
  && docker-php-ext-install pdo pdo_pgsql \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

# Copy app to web root
COPY . /var/www/html/

# Ensure correct ownership
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80




