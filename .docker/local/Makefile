#!/bin/bash
SHELL := /bin/bash

prepare-env:

_pre-script:
	xdebug.sh

_wait-db:
	wait-for-db.sh

run: _wait-db _pre-script prepare-env
	php-fpm -R --daemonize
	nginx
	tail -f /var/log/access.log & tail -f /var/log/nginx/access.log & tail -f /var/log/nginx/error.log
