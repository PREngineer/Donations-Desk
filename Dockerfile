# Base Image is latest Alpine
FROM alpine:3.8

# Maintainer information and description
LABEL maintainer="Jorge Pabón <pianistapr@hotmail.com>" description="A crowd-funding web application."

# Setup Apache and PHP 5.4, also create the directory that will hold our application files /app
RUN apk --no-cache --update \
    add apache2 \
    apache2-ssl \
    curl \
    php7-apache2 \
    php7-pdo \
    php7-pdo_dblib \
    php7-pdo_mysql \
    php7-pdo_odbc \
    php7-pdo_pgsql \
    php7-pdo_sqlite \
    php7-mysqli \
    php7-openssl \
    php7-bcmath \
    php7-bz2 \
    php7-calendar \
    php7-common \
    php7-ctype \
    php7-curl \
    php7-dom \
    php7-gd \
    php7-iconv \
    php-mbstring \
    php-phar \
    php-session \
    php7-xml \
    tzdata \
    && mkdir /app

# Copy our application to the /app directory
COPY ./App /app
RUN chmod -R 777 /app

# Create the /config directory
RUN mkdir /config
RUN chmod -R 777 /config

# Create the /run/apache2 directory, due to issue of it not being present in the alpine 3.8 image and not allowing to create the files in there.
RUN mkdir /run/apache2/
RUN chmod -R 777 /run/apache2

# Expose our web ports
EXPOSE 80 443

# Add the entrypoint script
ADD entrypoint.sh /
RUN ["chmod", "+x", "/entrypoint.sh"]

# Execute the entrypoint script
ENTRYPOINT ["/entrypoint.sh"]