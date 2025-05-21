#!/bin/bash
set -e

/home/wwwroot/filament-site-navigation/vendor/bin/pest
/home/wwwroot/filament-site-navigation/vendor/bin/pint
/home/wwwroot/filament-site-navigation/vendor/bin/phpstan analyse
