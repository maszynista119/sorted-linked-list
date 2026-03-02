FROM php:8.1-cli-alpine

WORKDIR /app

# Minimal system deps required for Composer
RUN apk add --no-cache git unzip $PHPIZE_DEPS

# Install ext-ds (used by DequeStrategy)
RUN pecl install ds \
    && docker-php-ext-enable ds

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

CMD ["php", "-v"]