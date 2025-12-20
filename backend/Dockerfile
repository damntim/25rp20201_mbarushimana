# Backend Dockerfile
FROM php:8.2-apache
LABEL maintainer="25rp20201_mbarushimana"

COPY backend /var/www/html
RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80
