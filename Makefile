.PHONY: up

up:
	@./docker/setup.sh
	@docker-compose -f docker/docker-compose.yml up --build
