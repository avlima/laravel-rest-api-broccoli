<?php

namespace App\Api\V1\Order\Providers;


use App\Api\V1\Order\Contracts\OrderRepositoryInterface;
use App\Api\V1\Order\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(OrderRepositoryInterface::class, function () {
            return new OrderRepository();
        });

    }
}