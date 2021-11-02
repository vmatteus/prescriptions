# Setup Base - Api

### Documentação geral

...

### Pré-requisitos:

Para trabalhar nesse projeto você ira precisar instalar:
     
*[ Docker ](https://www.docker.com/get-started)			

*[ Docker Compose ](https://docs.docker.com/compose/install/)

### Instalar o Mysql, caso seja necessário:

*[ Mysql ](https://github.com/vmatteus/docker-mysql)

Descobrindo o ip do docker: docker network inspect genial | grep Gateway

### Preparando o ambiente Docker:

    Subindo ambiente
        sudo docker-compose build
        sudo docker-compose up

    Entrando no ambiente docker:
        sudo docker exec -it prescription-api bash 

    Renomeie o arquivo .env.example para .env e faça os apontamentos do banco
        chmod 777 .env.example
        cp .env.example .env

    Gerar key do laravel
        php artisan key:gen