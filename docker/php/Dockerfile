FROM php:7.4.3-fpm-alpine3.11

COPY . /app
VOLUME ["/app"]
RUN ["chmod", "777", "/app/public/img"]
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
