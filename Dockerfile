FROM alpine:latest

RUN apk update && apk upgrade 

RUN apk add curl git composer php-ctype php-session php-tokenizer php-simplexml php-xml php-dom

CMD composer && /bin/sh