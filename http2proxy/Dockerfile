From ubuntu:vivid

MAINTAINER fevenor <fevenor@outlook.com>


# Set up building environment
RUN apt-get update \
 && apt install -y git-core build-essential autoconf libtool libssl-dev libxml2-dev pkg-config zlib1g-dev libev-dev libjansson-dev libjemalloc-dev libevent-dev squid3 \

# Get the latest code, build and install
 && set -x \
 && mkdir /tmp/work \
 && cd /tmp/work \
 && git clone https://github.com/tatsuhiro-t/spdylay.git \
 && git clone https://github.com/tatsuhiro-t/nghttp2.git \
 && cd spdylay \
 && autoreconf -i && automake && autoconf \
 && ./configure \
 && make && make install \
 && cd ../nghttp2/ \
 && autoreconf -i && automake && autoconf \
 && ./configure --prefix=/usr --sysconfdir=/etc --disable-examples --disable-python-bindings \
 && make && make install \
 && mkdir /etc/nghttpx \
 && mkdir /var/log/nghttpx \

# Tear down building environment and delete git repository
 && rm -rf /tmp/work \
 && apt-get --purge autoremove -y git-core build-essential autoconf libtool libxml2-dev pkg-config libjansson-dev libevent-dev

# Configure nghttp2 and squid
ADD config.sh /root/
ADD nghttpx.conf /etc/nghttpx/
ADD squid.conf /etc/squid3/squid.conf

ENV PORT 443
ENV WHETHER_VERIFY no

EXPOSE $PORT

CMD /root/config.sh; (squid3 &); nghttpx -L INFO
