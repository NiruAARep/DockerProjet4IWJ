FROM alpine:latest

RUN apk update

RUN apk add composer 

ENTRYPOINT /bin/sh 