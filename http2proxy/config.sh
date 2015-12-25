#!/bin/bash
sed -i -e "s/port_temp/$PORT/" \
 -e "s/verify_temp/$WHETHER_VERIFY/" \
 /etc/nghttpx/nghttpx.conf
