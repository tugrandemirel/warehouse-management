<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Currency;
use App\Models\MainConfig;
use App\Models\MeasurementUnit;
use App\Models\Product;
use App\Models\ProductOption;
use App\Observers\Company\CompanyObserver;
use App\Observers\Product\ProductObserver;
use App\Observers\Product\ProductOptionObserver;
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
        Product::observe(ProductObserver::class);
        ProductOption::observe(ProductOptionObserver::class);
        Company::observe(CompanyObserver::class);
    }
}
