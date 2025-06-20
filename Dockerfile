# Use the official PHP image with FPM and Nginx
FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the application
COPY . .

# Install npm dependencies and build assets
RUN npm install && npm run build

# Set permissions for storage and cache
RUN chown -R application:application /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 8080 (Render expects this)
EXPOSE 8080

# Start Nginx and PHP-FPM
CMD ["supervisord", "-n"]