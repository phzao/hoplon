up:
	@echo '************  Criando DB network ************'
	@echo '*'
	@echo '*'
	docker network inspect db_store >/dev/null 2>&1 || docker network create db_store
	@echo '************  Waking UP Containers ************'
	@echo '*'
	@echo '*'
	docker-compose up -d

	@echo '*'
	@echo '*'
	@echo '************  Preparing  ************'
	docker exec -it store-php composer install
	@echo '*'
	@echo '*'
	@echo '************  Running tests  ************'
	docker exec -it store-php ./vendor/bin/phpunit tests/

db_up:
	@echo '************  create db ************'
	docker exec -i store-database mysql -uroot -p123 <./database/create.sql
	@echo '************  run migrations db ************'
	docker exec -i store-php php -f runMigration.php