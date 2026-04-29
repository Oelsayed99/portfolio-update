# Use the official PHP 8.2 image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite for pretty URLs
RUN a2enmod rewrite

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory to the web root
WORKDIR /var/www/html

# Copy the project files to the container
# We will use volumes for development, but this is good for building
COPY . /var/www/html/

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html
