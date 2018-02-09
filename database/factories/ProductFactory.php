<?php

use App\Api\V1\Product\Models\ProductModel;
use Faker\Generator as Faker;

$factory->define(ProductModel::class, function (Faker $faker) {
    return [
        'nome' => $faker->word,
        'codigo' => $faker->unique()->numerify(),
        'preco_unitario' => $faker->randomFloat(2, 1, 8)
    ];
});
