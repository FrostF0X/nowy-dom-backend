#!/bin/bash
SHELL=/bin/bash -o pipefail
export
export COMPOSE_PROJECT_NAME=nowy-dom
PLATFORM := $(shell uname -s)
IS_MAC := $(shell [[ $(PLATFORM) =~ ^Darwin ]] && echo true)

ifeq ("$(IS_MAC)", "true")
	export COMPOSE_FILE=.docker/local/docker-compose.yml:.docker/local/docker-compose.mac.yml:.docker/local/docker-compose.local.yml:.docker/local/docker-compose.traefik.yml
	COMPOSE_COMMAND := mutagen-compose
else
	export COMPOSE_FILE=.docker/local/docker-compose.yml:.docker/local/docker-compose.linux.yml:.docker/local/docker-compose.local.yml:.docker/local/docker-compose.traefik.yml
	COMPOSE_COMMAND := docker-compose
endif
APP_EXEC := $(COMPOSE_COMMAND) exec app entrypoint.sh exec


build:
ifeq ("$(IS_MAC)", "true")
	$(COMPOSE_COMMAND) build
else
	$(COMPOSE_COMMAND) build --build-arg USER_ID=$(shell id -u) --build-arg GROUP_ID=$(shell id -g)
endif


start:
	$(COMPOSE_COMMAND) up -d --force-recreate --remove-orphans
	make logs

stop:
	$(COMPOSE_COMMAND) down

logs:
	$(COMPOSE_COMMAND) logs -f

exec:
	$(APP_EXEC)

exec-debug:
	$(APP_DEBUG_EXEC)
