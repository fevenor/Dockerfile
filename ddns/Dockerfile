FROM golang:1.15.6 AS golang

# Build
ADD ddns.go /go/src/ddns/
WORKDIR /go/src/ddns
RUN go get ddns
RUN go install

FROM alpine
LABEL maintainer="fevenor <fevenor@outlook.com>"

RUN apk add --no-cache ca-certificates

# Copy bin
COPY --from=golang /go/bin/ddns /usr/local/bin

# DDNS environment variables
ENV PORT 80
ENV CF_API_KEY example
ENV DOMAIN example.com

EXPOSE $PORT/tcp

# Start ddns server
CMD exec ddns
