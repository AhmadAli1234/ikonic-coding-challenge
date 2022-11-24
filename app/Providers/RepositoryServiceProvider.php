<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\RequestContract;
use App\Repositories\RequestRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RequestContract::class,RequestRepository::class);
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
