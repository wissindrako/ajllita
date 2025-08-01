setup:
	@make build
	@make up 
	@make composer-update-no-plugins
	@key
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec laravel-docker bash -c "composer update"
composer-update-no-plugins:
	docker exec laravel-docker bash -c "composer update --no-plugins"
permission-storage:
	docker exec laravel-docker bash -c "chmod o+w ./storage/ -R"
key:
	docker exec laravel-docker bash -c "php artisan key:generate"
data:
	docker exec laravel-docker bash -c "php artisan migrate"
	docker exec laravel-docker bash -c "php artisan db:seed"