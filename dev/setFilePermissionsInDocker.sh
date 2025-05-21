#!/bin/sh
set -e
cd /home/wwwroot/filament-site-navigation || exit
chown -R www-data:www-data /home/wwwroot/filament-site-navigation && \
find /home/wwwroot/filament-site-navigation -type f -exec chmod 644 {} \; && \
find /home/wwwroot/filament-site-navigation -type d -exec chmod 755 {} \; && \
chmod -R +x /home/wwwroot/filament-site-navigation/vendor/bin/ && \
chmod -R +x /home/wwwroot/filament-site-navigation/dev/
