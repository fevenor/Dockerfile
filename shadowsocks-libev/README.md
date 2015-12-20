# Shadowsocks Dockerized

## About this image

This image is built to ease the deployment of the Shadowsocks server daemon with Docker.

For Shadowsocks clients, you want to visit http://shadowsocks.org/en/download/clients.html

### What is Shadowsocks

A secure socks5 proxy designed to protect your Internet traffic.

See http://shadowsocks.org/

### What is Docker

An open platform for distributed applications for developers and sysadmins.

See https://www.docker.com/

## How to use this image

### Start the daemon for the first time

```bash
$ docker run -d --name ss --detach -p 11080:11080 fevenor/shadowsocks-libev -e PASSWORD="5ecret!"
```

### Stop the daemon

```bash
$ docker stop ss
```

### Start a stopped daemon

```bash
$ docker start ss
```

### Upgrade

Simply run a `docker pull` to upgrade the image.

```bash
$ docker pull fevenor/shadowsocks-libev
```

## References

* [Shadowsocks - Servers](http://shadowsocks.org/en/download/servers.html)
* [shadowsocks-libev](https://github.com/shadowsocks/shadowsocks-libev/blob/master/README.md)
