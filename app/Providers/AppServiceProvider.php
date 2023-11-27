<?php

namespace App\Providers;

use App\Models\VariantGroup;
use App\Observers\Product\Variant\VariantGroupObserver;
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
    }
}
