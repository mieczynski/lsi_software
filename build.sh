#!/bin/bash
docker-compose build --force
docker-compose up -d
docker exec lsi_software_php_1 composer install
docker exec lsi_software_php_1 php bin/console doctrine:migrations:migrate
docker exec lsi_software_php_1 php bin/console doctrine:fixtures:load --append
