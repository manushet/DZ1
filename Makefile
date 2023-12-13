docker-up:
	docker-compose up --build -d

docker-exec-php:
	docker exec -it life-cycle_lifecycle-php_1 bash

docker-down:
	docker-compose down -v --remove-orphans
