# event-manager
A simple dockerized laravel application to add, edit, view, archive and delete events with phpunit and feature test

#How to start
The instruction given her is based on Ubuntu 16.04 

##Dependencies
1) Docker
2) Docker-compose
3) Internet connection

##Setup docker container
1) sudo vim /etc/hosts and add 127.0.0.1 eventm.zit in the host list
2) cd /into/event-manager/docker
3) run docker-compose build (for the first time only)
4) run docker-compose up and wait for something like

    Creating docker_emubuntu1604_1_264e8608433b ... done
    
    Creating docker_emmysql_1_daa7730f61f6      ... done
    
5) run docker ps and you should see something like

    CONTAINER ID---IMAGE---and more...
    
    123ertg5678---docker_emubuntu1604---and more...
    
    989888hjnb6---mysql:5.7.24---and more...
    
6) run docker exec -itu eventm CONTAINER_ID bash and now you should be in the docker container
7) cd /var/www/html/eventm
8) run composer update
9) run php artisan migrate (if did not work please run php artisan config:clear and try again to migrate)
10) run vendor/bin/phpunit and you should see something like **OK (5 tests, 5 assertions)**
11) open http://eventm.zit:8081 in the browser and you should see the welcome page

##Error handling
Please run **sudo chmod -R 0777 /var/www/html/eventm/storage** if you see the error below

UnexpectedValueException
The stream or file "/var/www/html/eventm/storage/logs/laravel.log" could not be opened: failed to open stream: Permission denied

