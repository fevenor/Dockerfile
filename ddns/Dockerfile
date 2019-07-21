FROM golang:alpine AS golang

# Build
ADD ddns.go /root/
RUN apk add --no-cache git build-base \
    && cd /root \
    && go get -d \
    && go build -o ddns

FROM alpine
LABEL maintainer="fevenor <fevenor@outlook.com>"

RUN apk add --no-cache ca-certificates

# Copy bin
COPY --from=golang /root/ddns /usr/local/bin

# DDNS environment variables
ENV PORT 80
ENV CF_API_KEY example
ENV CF_API_EMAIL admin@example.com
ENV DOMAIN example.com

EXPOSE $PORT/tcp

# Start ddns server
CMD exec ddns
