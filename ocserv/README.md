# OpenConnect server Dockerized

## About this image

This image is built to ease the deployment of the OpenConnect server daemon with Docker.

### What is OpenConnect Server

[OpenConnect server (ocserv)](http://www.infradead.org/ocserv/) is an SSL VPN server. It implements the OpenConnect SSL VPN protocol, and has also (currently experimental) compatibility with clients using the [AnyConnect SSL VPN](http://www.cisco.com/c/en/us/support/security/anyconnect-vpn-client/tsd-products-support-series-home.html) protocol.

### What is Docker

An open platform for distributed applications for developers and sysadmins.

See https://www.docker.com/

## How to use this image

### Start the daemon for the first time

```bash
$ docker run -d -v <ocserv config path>:/etc/ocserv --name ocserv --privileged -p 443:443 -p 443:443/udp fevenor/ocserv
```

### Stop the daemon

```bash
$ docker stop ocserv
```

### Start a stopped daemon

```bash
$ docker start ocserv
```

### Upgrade

Simply run a `docker pull` to upgrade the image.

```bash
$ docker pull fevenor/ocserv
```

## References

* [tommylau/ocserv](https://github.com/TommyLau/docker-ocserv)
* [soniclidi/alpine-ocserv](https://github.com/soniclidi/alpine-ocserv)
