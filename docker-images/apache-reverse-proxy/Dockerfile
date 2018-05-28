FROM php:7.0-apache

RUN apt-get update && apt-get install -y nano
RUN apt-get install -y net-tools
COPY apache2-foreground /usr/local/bin/
COPY templates /var/apache2/templates
COPY conf/ /etc/apache2

RUN a2enmod proxy
RUN a2enmod proxy_http
RUN a2enmod proxy_balancer
RUN a2enmod lbmethod_byrequests slotmem_shm
RUN a2ensite 000-* 001-*
