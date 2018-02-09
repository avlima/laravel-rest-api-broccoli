# uds-desafio-back-end
Teste para candidatos à vaga de backend
by **Alberto Vieira de Lima (avlima|albertovieiradelima@gmail.com)**

## Ambiente
> - PHP 7.1
> - Mysql 5.6.31
> - Git e GitFlow
> - Linux


## Instalação do projeto

### Instalando o composer
> Obtendo o composer:
```bash
curl -sS https://getcomposer.org/installer | php
```
> Ou:
```bash
php -r "readfile('https://getcomposer.org/installer');" | php
```
> Na raiz do projeto execute:
```bash
composer install
```

### Configurando banco de dados
> Renomeie o arquivo .env.example para .env e configure seu banco no arquivo, preencha seus dados de conexão deixando vazio o DB_DATABASE, como descrito abaixo:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=usuario
DB_PASSWORD=senha
```

### Criando e populando a base de dados
> Isso mesmo, não precisa criar o schema de banco a própria aplicação faz isso por você. Execute o comando abaixo para criar o schema `uds_desafio`
```bash
php artisan create-db
```

> Instalando a migrate para versionar nosso banco:
```bash
php artisan migrate:install
```

> Criando as tabelas do projeto:
```bash
php artisan migrate
```

> Populando com dados fictícios nossa base de dados
```bash
php artisan db:seed
```

## Sobre o projeto
> Como o próprio teste solicita, ele é uma API Rest. Isso mesmo que vocês estão pensando! Acharam que iria ter telinha bonitinha com booststrap?<br>
Não não, se é API então que seja API e vocês terão que testar na raça ou não vai valer de nada meu esforço pra ficar até as 5h da manhã durante 3 dias para fazer essa belezura.
Fiquem tranquilos eu não sou tão mau, eu vou deixar minha collection do Postman para vocês terem todas as rotas de API em mãos.

### Importante saber
> Todos os ids estão utilizando o padrão Uuid.<br>
A aplicação foi feita com design patterns.<br>
A por favor né só `view -> controller -> view`? aqui não.<br>
Aqui a parada é mais séria `request -> controller -> provider -> interface -> repository -> model`.<br>
Deu medinho? Aqui é raiz, sai pra lá nutella.

#### Bora para o que interessa.

### Nossas rotas (routes)
![](https://user-images.githubusercontent.com/13434925/36053895-d1a3ad60-0dda-11e8-9218-9f1aadd7ee04.png)
> Todas as rotas Api com exceção DELETE, aceitam o parametro response_type (json, xml, csv, array, yaml). Exemplo: `url?response_type=csv`<br>
> Rotas POST retornará o status 201 de create, já as DELETE retornará 204 not content. (só pra deixar claro ;))<br>
> Devido ao tempo curto de esforço no projeto, eu não trabalhei em formatação de datas e etc...

### Estrutura do projeto
> Foi pedido no teste para da uma lapidada no laravel já que ele é flexível e tal. Bom, minha opinião para vocês seria fazer em lumem já que o teste é uma API mesmo, com isso mesmo tranqueira pra limpar.(Detalhe eu não limpei muita coisa não, não tive tempo nem pra dormir então deixa quieto aí que o pouco que ta sobrando nao vai atrapalhar a gente não.)<br>

> Estrutura base: **App\Api\V1** costumo fazer assim para APIs versionadas.<br>
> Dentro do diretório **V1** teremos os módulos *Person, Product e Order*, e por sua vez cada um deles possui *Contracts, Controllers, Providers, Repositories e Models.*

### Aproveitando de tudo um pouco do laravel
> Console, Factory, Migration, Seeder, Enum<br>
> Os erros estão sendo centralizados no Handler, com isso o tratamento de erros fica muito mais fácil e retornando json ;)

### Test PHPUnit
> Cada API tem sua classe de teste, porém se quiser rodar todos de uma só vez execute na raiz do projeto:
```bash
vendor/bin/phpunit
```
> Lembro que fiz os testes de request, mas nada muito complexo.

### Facilitando sua vida
> Voce utiliza o Postman então aproiveita esse link e baixa a collection com todas as rotas configuradas e populas: https://www.getpostman.com/collections/2144d2cfff909266d329<br>
> Se o link estiver quebrado então você pode pegar essa collection em formato json no diretorio `resources/assets/UDS-Desafio.postman_collection.json`

## Rodando o projeto
> Artisan serve
```bash
php artisan serve
```
> Ou Built-in Web Server
```bash
php -S 127.0.0.1:8000 -t public/
```
## Copyright and license

Code and documentation copyright (c) 2018, Code released under the New BSD license.

