<?php

use App\Api\V1\Product\Models\ProductModel;
use Faker\Generator as Faker;

$factory->define(ProductModel::class, function (Faker $faker) {
    return [
        'nome' => $faker->unique()->word.rand(1, 999),
        'codigo' => $faker->unique()->randomDigit,
        'preco_unitario' => $faker->randomFloat(2, 1, 8)
    ];
});
