FROM golang:1.15.6 AS golang

# Build
ADD . /go/src/ddns
WORKDIR /go/src/ddns
RUN go build -o ddns

FROM alpine
LABEL maintainer="fevenor <fevenor@outlook.com>"

RUN apk add --no-cache ca-certificates

# Copy bin
COPY --from=golang /go/src/ddns/ddns /usr/local/bin

# DDNS environment variables
ENV PORT 80
ENV CF_API_KEY example
ENV DOMAIN example.com

EXPOSE $PORT/tcp

# Start ddns server
CMD exec ddns
