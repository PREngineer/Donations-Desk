# Base image
FROM alpine:3.24.3

# Maintainer information and description
LABEL maintainer="Jorge Pabón <pianistapr@hotmail.com>" \
      description="A crowd-funding web application."

# Install Apache, PHP 8.4 and required extensions
RUN apk add --no-cache \
    apache2 \
    apache2-ssl \
    curl \
    php84 \
    php84-apache2 \
    php84-bcmath \
    php84-bz2 \
    php84-calendar \
    php84-common \
    php84-ctype \
    php84-curl \
    php84-dom \
    php84-gd \
    php84-iconv \
    php84-mbstring \
    php84-mysqli \
    php84-mysqlnd \
    php84-openssl \
    php84-pdo \
    php84-pdo_dblib \
    php84-pdo_mysql \
    php84-pdo_odbc \
    php84-pdo_pgsql \
    php84-pdo_sqlite \
    php84-phar \
    php84-session \
    php84-xml \
    && mkdir -p /app /config

# Copy the application files
COPY ./App /app

# Preserve existing permissions for application compatibility
RUN chmod -R 777 /app /config

# Expose HTTP and HTTPS
EXPOSE 80 443

# Add the entrypoint script
COPY entrypoint.sh /entrypoint.sh

# Normalize Windows line endings and set executable permissions
RUN sed -i 's/\r$//' /entrypoint.sh \
    && chmod 755 /entrypoint.sh

# Start using the shell explicitly
ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]