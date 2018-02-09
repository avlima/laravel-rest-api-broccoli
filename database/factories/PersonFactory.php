<?php

use App\Api\V1\Person\Models\PersonModel;
use Faker\Generator as Faker;

$factory->define(PersonModel::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cpf' => '046.216.689-94',
        'data_nascimento' => $faker->date()
    ];
});
