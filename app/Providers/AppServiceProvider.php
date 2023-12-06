<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\MainConfig;
use App\Models\MeasurementUnit;
use App\Observers\Settings\Product\CurrencyObserver;
use App\Observers\Settings\Product\MainConfigObserver;
use App\Observers\Settings\Product\MeasurementUnitObserver;
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
        MainConfig::observe(MainConfigObserver::class);
        MeasurementUnit::observe(MeasurementUnitObserver::class);
    }
}
