
init:
	cp ./backend/Docker/fpm/.env ./backend/.env
	cp ./frontend/Docker/.env ./frontend/.env
	cp ./backend/Docker/sqlite/database.sqlite ./backend/database/database.sqlite

start:
	docker compose -f ./backend/docker-compose.yml up -d --build
	docker compose -f ./frontend/docker-compose.yml up -d --build

end:
	docker compose -f ./backend/docker-compose.yml down --remove-orphans
	docker compose -f ./frontend/docker-compose.yml down --remove-orphans
