<?php

use App\Api\V1\Order\Models\OrderModel;
use App\Api\V1\Person\Models\PersonModel;
use Faker\Generator as Faker;

$factory->define(OrderModel::class, function (Faker $faker) {
    return [
        'cliente' => function () {
            return factory(PersonModel::class)->create()->id;
        },
        'numero' => $faker->unique()->randomNumber(),
        'emissao' => $faker->date(),
        'total' => 95
    ];
});
