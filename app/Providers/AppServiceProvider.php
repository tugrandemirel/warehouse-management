<?php

namespace App\Providers;

use App\Models\Variant;
use App\Models\VariantGroup;
use App\Observers\Product\Variant\VariantGroupObserver;
use App\Observers\Product\Variant\VariantObserver;
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
        VariantGroup::observe(VariantGroupObserver::class);
        Variant::observe(VariantObserver::class);
    }
}
