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
app-init: composer-update  artisan-key-generate  artisan-storage-link migrate-seed npm-install npm-build

composer-update:
	${docker_composer} exec app composer update
artisan-key-generate:
	${docker_composer} exec app php artisan key:generate
artisan-storage-link:
	rm -r public/storage; ${docker_composer} exec app php artisan storage:link
sh:
	${docker_composer} exec app sh
npm-install:
	${docker_composer} exec app npm install
npm-build:
	${docker_composer} exec app  npm run build
npm-dev:
	${docker_composer} exec app npm run dev
migrate:
	${docker_composer} exec app php artisan migrate:fresh
migrate-seed:
	${docker_composer} exec app php artisan migrate --seed
tinker:
	${docker_composer} exec app php artisan tinker
test:
	${docker_composer} exec app php artisan test
