# Имя локального пользователя, можно посмотреть командой echo $USER
USER = dnezhkin

# Собрать docker-образы
build:
	docker-compose build --no-cache

# Запустить
up:
	docker-compose up -d

unlock:
	chown -R ${SUDO_USER}:rootgroup ./app
	chmod 775 ./app

build_php:
	docker build ./docker/php --tag dex_php_im --no-cache