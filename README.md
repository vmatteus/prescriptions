# Setup Prescriptions - Api

### Documentação geral

Na aba actions, aqui do repositório estão as actions que sobem e testam o código.

### Pré-requisitos:

Para trabalhar nesse projeto você ira precisar instalar:
     
*[ Docker ](https://www.docker.com/get-started)			

*[ Docker Compose ](https://docs.docker.com/compose/install/)

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
