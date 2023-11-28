<?php

namespace App\Providers;

use App\Models\Currency;
use App\Observers\Settings\Product\CurrencyObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Currency::observe(CurrencyObserver::class);
    }
}
