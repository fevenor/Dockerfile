FROM alpine

MAINTAINER fevenor <fevenor@outlook.com>

ENV PORT 443

# Set up runing environment
RUN echo "@testing http://dl-4.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories \
 && apk add --update musl-dev iptables gnutls-dev readline-dev libnl3-dev lz4-dev libseccomp-dev@testing \

# Get the latest code, build and install
 && buildDeps="xz openssl gcc autoconf make linux-headers" \
 && set -x \
 && apk add $buildDeps \
 && cd /root \
# && wget http://www.infradead.org/ocserv/download.html -O download.html \
# && OC_VERSION=`sed -n 's/^.*version is <b>\(.*\)$/\1/p' download.html` \
# && rm -fr download.html \
 && OC_VERSION="0.10.2" \
 && OC_FILE="ocserv-$OC_VERSION" \
 && wget ftp://ftp.infradead.org/pub/ocserv/$OC_FILE.tar.xz \
 && tar xJf $OC_FILE.tar.xz \
 && rm -fr $OC_FILE.tar.xz \
 && cd $OC_FILE \
 && ./configure \
 && make \
 && make install \
 && mkdir -p /etc/ocserv \

# Tear down building environment and delete source code
 && cd .. \
 && rm -fr ./$OC_FILE \
 && apk del --purge $buildDeps \
 && rm -rf /var/cache/apk/* \

# Setting IP forward
 && echo "net.ipv4.ip_forward = 1" >> /etc/sysctl.conf \
 && echo "net.ipv6.conf.all.forwarding = 1" >> /etc/sysctl.conf

EXPOSE $PORT
EXPOSE $PORT/udp

CMD iptables -t nat -A POSTROUTING -j MASQUERADE;ocserv -c /etc/ocserv/ocserv.conf -f -d 1
