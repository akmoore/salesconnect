<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AgencyProvider extends ServiceProvider
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
            'App\SalesConnect\Helpers\Interfaces\AgencyInterface',
            'App\SalesConnect\Helpers\Repositories\AgencyRepo'
        );
    }
}
