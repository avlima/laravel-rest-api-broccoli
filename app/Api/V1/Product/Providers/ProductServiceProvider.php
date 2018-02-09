<?php

namespace App\Api\V1\Product\Providers;


use App\Api\V1\Product\Contracts\ProductRepositoryInterface;
use App\Api\V1\Product\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ProductRepositoryInterface::class, function () {
            return new ProductRepository();
        });

    }
}