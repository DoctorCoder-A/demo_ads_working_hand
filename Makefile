init: docker-down-clean docker-build docker-up app-init
start: docker-down-clean docker-up
down: docker-down-clean
up: docker-up

env := ./.env.docker
ifneq (,$(wildcard ${env}))
    include .env.docker
    export
endif

docker_composer := docker compose  --env-file ${env} -p ${PROJECT_NAME}

docker_resolve:
	${docker_composer} config
docker-build:
	${docker_composer} build
docker-up:
	${docker_composer} up -d --remove-orphans
docker-down-clean:
	${docker_composer} down -v --remove-orphans

app-init: composer-update artisan-key-generate

composer-update:
	${docker_composer} exec app composer update
artisan-key-generate:
	${docker_composer} exec app php artisan key:generate
artisan-storage-link:
	([ -L "public/storage" ] && rm -r public/storage) && ([ -d "storage/app/public" ] || mkdir storage/app/public) && ${docker_composer} exec app php artisan storage:link
sh:
	${docker_composer} exec app sh
migrate:
	${docker_composer} exec app php artisan migrate:fresh
tinker:
	${docker_composer} exec app php artisan tinker
test:
	${docker_composer} exec app php artisan test
