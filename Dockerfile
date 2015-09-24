FROM php:5.6.13-apache
MAINTAINER Rizza Mendoza <mendoza.rizza@gmail.com>

COPY index.php /var/www/html/index.php

EXPOSE 80