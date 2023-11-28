<?php

namespace App\Observers\Settings\Product;

use App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum;
use App\Models\Currency;

class CurrencyObserver
{
    /**
     * Handle the Currency "created" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function saving(Currency $currency)
    {
        if ($currency->is_default == CurrencyIsDefaultEnum::TRUE) {
            $currency->is_default = CurrencyIsDefaultEnum::TRUE;
            Currency::where('user_id', $currency->user_id)->update(['is_default' => false]);
        }
        $currency->user_id = auth()->user()->id;
        $currency->name = strtoupper($currency->name);
    }

    /**
     * Handle the Currency "updated" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function updated(Currency $currency)
    {
        //
    }

    /**
     * Handle the Currency "deleted" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function deleted(Currency $currency)
    {
        //
    }

    /**
     * Handle the Currency "restored" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function restored(Currency $currency)
    {
        //
    }

    /**
     * Handle the Currency "force deleted" event.
     *
     * @param  \App\Models\Currency  $currency
     * @return void
     */
    public function forceDeleted(Currency $currency)
    {
        //
    }
}
