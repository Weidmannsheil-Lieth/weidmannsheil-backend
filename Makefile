
setup: composer setup-env start migrate-fresh db-seed

setup-env:
	# Copy .env
	if [ ! -f ".env" ]; then cp .env.example .env; fi

start:
	# Starting
	sudo docker-compose up -d

composer:
	# Installing composer
	composer install --ignore-platform-reqs

migrate-fresh:
	# Migrating
	sudo ./vendor/bin/sail artisan migrate:fresh

db-seed:
	# Seeding
	sudo ./vendor/bin/sail artisan db:seed



