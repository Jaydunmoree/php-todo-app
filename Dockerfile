
FROM php:8.1-apache

# Install libpq (Postgres client dev libs) and build pdo_pgsql
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mysqli pdo_pgsql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy app into web root
COPY . /var/www/html/

# Fix ownership
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80



