# Base Image is latest Alpine
FROM alpine:3.8

# Maintainer information and description
LABEL maintainer="Jorge Pabón <pianistapr@hotmail.com>" description="A crowd-funding web application."

# Setup Apache and PHP 5.4, also create the directory that will hold our application files /app
RUN apk --no-cache --update \
    add apache2 \
    apache2-ssl \
    curl \
    php5-apache2 \
    php5-pdo \
    php5-pdo_dblib \
    php5-pdo_mysql \
    php5-pdo_odbc \
    php5-pdo_pgsql \
    php5-pdo_sqlite \
    php5-mysqli \
    php5-openssl \
    php5-bcmath \
    php5-bz2 \
    php5-calendar \
    php5-common \
    php5-ctype \
    php5-curl \
    php5-dom \
    php5-gd \
    php5-iconv \
    php-mbstring \
    php-phar \
    php-session \
    php5-xml \
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