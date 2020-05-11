
FROM 459below/mariadb-armv7 AS mariadb_server
COPY ./app/bd/ecomueble.sql ./
COPY ./app/bd/populate_ecomueble2.sql ./


FROM php:7.2.1-apache AS php_apache
MAINTAINER egidio docile
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN service apache2 restart
EXPOSE 80
EXPOSE 8080