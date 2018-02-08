# uds-desafio-back-end
Teste para candidatos à vaga de backend

composer install

configure seu banco no arquivo .env igual descrito abaixo deixando vazio o Database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=root
DB_PASSWORD=rigole

php artisan create-db

php artisan migrate:install

php artisan migrate