<?php

namespace App\Providers;

use App\Contracts\UserContract;
use App\Contracts\OrderContract;
use App\Contracts\ProductContract;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(OrderContract::class, OrderRepository::class);
        $this->app->bind(ProductContract::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
