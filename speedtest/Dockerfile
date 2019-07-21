FROM ulsmith/alpine-apache-php7
LABEL maintainer="fevenor <fevenor@outlook.com>"

# Copy web
ADD html /app/public

EXPOSE 80
ENTRYPOINT ["/bootstrap/start.sh"]