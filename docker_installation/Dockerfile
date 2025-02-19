# Use the official PHP image as the base image
FROM php:8.2-cli

# Set the working directory
WORKDIR /app

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Expose port 9000
EXPOSE 9001

# Keep the container alive
CMD ["tail", "-f", "/dev/null"]