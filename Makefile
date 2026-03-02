composer:
	docker-compose run --rm php composer install

test:
	docker-compose run --rm php vendor/bin/phpunit

stan:
	docker-compose run --rm php vendor/bin/phpstan analyse

shell:
	docker-compose run --rm php sh
cs-fix:
	docker-compose run --rm php vendor/bin/php-cs-fixer fix
cs:
	docker-compose run --rm php vendor/bin/phpcs --standard=.phpcs.xml
start:
	docker-compose up -d