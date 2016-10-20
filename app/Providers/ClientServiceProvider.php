<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\SalesConnect\Helpers\Interfaces\ClientInterface',
            'App\SalesConnect\Helpers\Repositories\ClientRepo'
        );
    }
}
