FROM ankermarco/php5

MAINTAINER Ke Ma <ke.ma@wearesuburb.com>

# Add custom php.ini
#COPY config/php.ini /usr/local/etc/php/

RUN echo "include_path = "/usr/local/etc/php" " >> /etc/php5/apache2/php.ini

RUN chown -R www-data:www-data /var/www/html
RUN find /var/www/html -type d -exec chmod 700 {} \; && find . -type f -exec chmod 600 {} \;

RUN usermod -u 1000 www-data
RUN a2enmod rewrite



