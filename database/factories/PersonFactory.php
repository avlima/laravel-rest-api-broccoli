<?php

use App\Api\V1\Person\Models\ProductModel;
use Faker\Generator as Faker;

$factory->define(ProductModel::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cpf' => '046.216.689-94',
        'data_nascimento' => $faker->date()
    ];
});
