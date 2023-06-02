COMPOSE_PROJECT_NAME := application

prod:
	docker-compose --env-file=./src/.env \
 		-f infrastructure/docker-compose.yml \
		up -d --build --remove-orphans
	docker exec -it pp mkdir -p "../infrastructure/db"
	docker exec -it pp chmod -R 777 .
	docker exec -it pp composer install
	docker exec -it pp bash -c 'php artisan key:generate'
	docker exec -it pp bash -c 'php artisan migrate'
	docker exec -it pp bash -c 'php artisan db:seed'

test:
	docker-compose --env-file=./src/.env \
		-f infrastructure/docker-compose-test.yml \
		up -d --build --remove-orphans
	docker exec -it pt mkdir -p "../infrastructure/dbtest"
	docker exec -it pt chmod -R 777 .
	docker exec pt composer install
	docker exec -it pt bash -c 'php artisan key:generate'
	docker exec -it pt bash -c 'php artisan migrate:refresh'
	docker exec -it pt bash -c 'php artisan db:seed'
	docker exec -it pt bash -c 'php artisan test'
