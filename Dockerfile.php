FROM alpine:latest

RUN apk update && \
    apk upgrade && \
    apk add --no-cache \
    wget \
    php \
    php-cli \
    php-json \
    php-phar \
    php-openssl \
    php-dom \
    php-mbstring \
    php-pdo \
    php-pdo_pgsql \
    php-tokenizer \
    php-xml \
    php-ctype \
    php-session \
    php-iconv \
    php-simplexml \
    php-intl \
    php-xmlwriter \
    php-fileinfo