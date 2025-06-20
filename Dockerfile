# Use the official PHP image with FPM and Nginx
FROM webdevops/php-nginx:8.2

# Set working directory
WORKDIR /var/www/html

# Copy the rest of the application
COPY . .

# Install system dependencies, Node.js, and npm
RUN apt-get update && \
    apt-get install -y curl && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install JS dependencies and build assets
RUN npm install && npm run build

# Set permissions, etc.
RUN chown -R application:application /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080

CMD ["supervisord", "-n"]