build:
	docker-compose build --no-cache --force-rm

stop:
	docker-compose stop

up:
	docker-compose up -d

start:
	docker-compose restart

install-laravel:
	docker-compose run composer create-project laravel/laravel:^10.0 .