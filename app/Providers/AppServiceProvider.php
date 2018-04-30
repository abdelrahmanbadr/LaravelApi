<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BreweryDb;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $brewery = new BreweryDb();
        $this->app->instance('brewerydb', $brewery);
    }
}
