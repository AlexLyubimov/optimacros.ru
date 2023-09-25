FROM php:8.1-cli

COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer

RUN apt-get update -y && apt-get upgrade -y && apt-get install -y \
    zip \
# Clear cache
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
