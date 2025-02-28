.PHONY: up down build schema test run

up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

schema:
	docker-compose exec app php bin/console orm:schema-tool:update --force

test:
	docker-compose exec app vendor/bin/phpunit

run:
	docker-compose exec app php index.php