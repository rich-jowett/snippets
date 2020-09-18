.PHONY: help build clean install serve unserve update test

include .env

COMPOSER_ARGS ?=

OAUTH_CLIENT ?=

COLOR_RESET   = \033[0m
COLOR_INFO    = \033[32m
COLOR_COMMENT = \033[33m

## Help
help:
	@printf "${COLOR_COMMENT}Usage:${COLOR_RESET}\n"
	@printf " make [target]\n\n"
	@printf "${COLOR_COMMENT}Available targets:${COLOR_RESET}\n"
	@awk '/^[a-zA-Z\-_0-9\.@]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf " ${COLOR_INFO}%-16s${COLOR_RESET} %s\n", helpCommand, helpMessage; \
		} \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)

# SOURCE : http://stackoverflow.com/questions/10858261/abort-makefile-if-variable-not-set
# Check that given variables are set and all have non-empty values,
# die with an error otherwise.
#
# Params:
#   1. Variable name(s) to test.
#   2. (optional) Error message to print.
check_defined = \
	$(strip $(foreach 1,$1, \
		$(call __check_defined,$1,$(strip $(value 2)))))
__check_defined = \
	$(if $(value $1),, \
		$(error Undefined $1$(if $2, ($2))))

#######################
# BUILDING TASKS
#######################

## Build dependencies
build:
	composer self-update
	composer install --prefer-source --no-interaction $(COMPOSER_ARGS)
	npm install

## Clean vendors, node_modules, cache, logs, assets, etc.
clean:
	php artisan migrate:reset
	php artisan cache:clear
	php artisan config:clear
	php artisan route:clear
	rm -rf vendor/ node_modules/ storage/logs/*.log

## Setup all the required settings for the app
install:
	composer run post-root-package-install
	composer run post-create-project-cmd
	php artisan migrate
	php artisan passport:install
	$(eval SOMETHING=$(shell sh -c "php artisan passport:client --no-interaction --name=\"Snippets API\" --redirect_uri=$(APP_URL)/callback | cut -s -d: -f2 | tr '\n' ':' | tr -d '[:space:]'"))
	$(eval CLIENT_ID=$(firstword $(subst :, ,$(SOMETHING))))
	$(eval CLIENT_SECRET=$(lastword $(subst :, ,$(SOMETHING))))
	@sed "/^OAUTH_CLIENT_ID=/{h;s/=.*/=${CLIENT_ID}/};${x;/^$/{s//OAUTH_CLIENT_ID=$(CLIENT_ID)/;H};x}" -i .env
	@sed '/^OAUTH_CLIENT_SECRET=/{h;s/=.*/=$(CLIENT_SECRET)/};${x;/^$/{s//OAUTH_CLIENT_SECRET=$(CLIENT_SECRET)/;H};x}' -i .env
	@echo Snippets API OAUTH client was created, your .env file was updated.

## Serve the application (one for the app and one for OAuth)
serve:
	php artisan serve --host=localhost --port=8000 &
	php artisan serve --host=localhost --port=8001 &

## Stop serving the application
unserve:
	ps -efw | grep -E -i -w 'localhost:800(1|0)(.*)/snippets/server.php'

## Update / create composer.lock file
update:
	composer update --lock $(COMPOSER_ARGS)

#######################k
# TESTING TASKS
#######################

## Run all tests (unit tests, code style, linters, etc.)
test:
	php vendor/bin/phpcs --standard=PSR12 app tests
	php vendor/bin/phpunit
