<?php

use App\Api\V1\Order\Models\OrderItemModel;
use App\Api\V1\Order\Models\OrderModel;
use App\Api\V1\Product\Models\ProductModel;
use Faker\Generator as Faker;

$factory->define(OrderItemModel::class, function (Faker $faker) {
    return [
        'produto' => function () {
            return factory(ProductModel::class)->create()->id;
        },
        'preco_unitario' => 100,
        'desconto' => 5,
        'total' => 95,
        'pedido' => function () {
            return factory(OrderModel::class)->create()->id;
        },
    ];
});
