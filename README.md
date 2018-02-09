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

php artisan db:seed

Api accept response types (json, xml, csv, array, yaml)

# Routes
+--------+-----------+------------------------+----------------+---------------------------------------------------------+------------+
| Domain | Method    | URI                    | Name           | Action                                                  | Middleware |
+--------+-----------+------------------------+----------------+---------------------------------------------------------+------------+
|        | GET|HEAD  | api/v1/person          | person.index   | \App\Api\V1\Person\Controllers\PersonController@index   | api        |
|        | POST      | api/v1/person          | person.store   | \App\Api\V1\Person\Controllers\PersonController@store   | api        |
|        | GET|HEAD  | api/v1/person/{person} | person.show    | \App\Api\V1\Person\Controllers\PersonController@show    | api        |
|        | PUT|PATCH | api/v1/person/{person} | person.update  | \App\Api\V1\Person\Controllers\PersonController@update  | api        |
|        | DELETE    | api/v1/person/{person} | person.destroy | \App\Api\V1\Person\Controllers\PersonController@destroy | api        |
+--------+-----------+------------------------+----------------+---------------------------------------------------------+------------+

#Api Person

GetAll (GET)

search
http://localhost:8000/api/v1/person?response_type=json&nome=w&cpf=046.216.689-94&data_nascimento=1984-08-27
or all
http://localhost:8000/api/v1/person

GetById
http://localhost:8000/api/v1/person/26e20fa0-0d31-11e8-9cd3-93477534f4a0

Create (POST)
http://localhost:8000/api/v1/person
data ex:
{
    "nome": "Alberto Vieira de Lima",
    "cpf": "046.216.689-94",
    "data_nascimento": "1974-04-13"
}

UPDATE (PUT)
http://localhost:8000/api/v1/person/a7a13fb0-0d1c-11e8-92fa-870784b441b6?response_type=xml
data ex:
{
    "nome": "Alberto Vieira de Carvalho",
    "cpf": "046.216.689-94",
    "data_nascimento": "1974-04-13"
}

Delete (DELETE)
http://localhost:8000/api/v1/person/3f387810-0d27-11e8-a842-f55153faac7d
response no content 204