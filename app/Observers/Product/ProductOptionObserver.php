<?php

namespace App\Observers\Product;

use App\Models\ProductOption;
use Illuminate\Support\Str;

class ProductOptionObserver
{
    /**
     * Handle the ProductOption "created" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function creating(ProductOption $productOption)
    {
        $productOption->user_id = auth()->user()->id;
        if ($productOption->product_code == auth()->user()->getMainConfig()->stock_prefix)
            $productOption->product_code .= Str::random(5);

    }

    /**
     * Handle the ProductOption "updated" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function updated(ProductOption $productOption)
    {
        $productOption->user_id = auth()->user()->id;
    }

    /**
     * Handle the ProductOption "deleted" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function deleted(ProductOption $productOption)
    {
        //
    }

    /**
     * Handle the ProductOption "restored" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function restored(ProductOption $productOption)
    {
        //
    }

    /**
     * Handle the ProductOption "force deleted" event.
     *
     * @param  \App\Models\ProductOption  $productOption
     * @return void
     */
    public function forceDeleted(ProductOption $productOption)
    {
        //
    }
}
