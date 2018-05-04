<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BreweryDb;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
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
