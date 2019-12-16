<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Eloquent\UserContract;
use App\Contracts\Eloquent\OrderContract;
use App\Contracts\Eloquent\ProductContract;
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
