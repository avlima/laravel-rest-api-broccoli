<?php

namespace App\Api\V1\Person\Providers;


use App\Api\V1\Person\Contracts\PersonRepositoryInterface;
use App\Api\V1\Person\Repositories\PersonRepository;
use Illuminate\Support\ServiceProvider;

class PersonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PersonRepositoryInterface::class, function () {
            return new PersonRepository();
        });

    }
}