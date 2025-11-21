FROM php:8.5-apache

WORKDIR /srv/semweb.lukeblaney.co.uk

# Use the default production configuration
COPY src/php.ini /usr/local/etc/php/conf.d/
RUN echo "ServerName localhost\nServerAdmin webmaster@localhost" >> /etc/apache2/apache2.conf
RUN rm /etc/apache2/sites-available/000-default.conf
COPY src/vhost.conf /etc/apache2/sites-available/semweb.lukeblaney.co.uk.conf
RUN a2enmod rewrite
RUN a2ensite semweb.lukeblaney.co.uk

COPY src/inc ./inc
COPY src/public ./public

ENV PORT 80
EXPOSE $PORT