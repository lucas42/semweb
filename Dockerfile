FROM alpine AS hugo-build

WORKDIR /hugo
RUN apk add --repository=https://dl-cdn.alpinelinux.org/alpine/edge/community hugo
COPY src/. .
RUN hugo

FROM php:5.4-apache

WORKDIR /srv/lukeblaney.co.uk

# Use the default production configuration
COPY src/php.ini /usr/local/etc/php/conf.d/
RUN echo "ServerName localhost\nServerAdmin webmaster@localhost" >> /etc/apache2/apache2.conf
COPY src/vhost.conf /etc/apache2/sites-available/lukeblaney.co.uk.conf
RUN a2enmod rewrite
RUN a2ensite lukeblaney.co.uk

COPY src/legacy-php/. ./
COPY --from=hugo-build /hugo/public/. ./

ENV PORT 80
EXPOSE $PORT