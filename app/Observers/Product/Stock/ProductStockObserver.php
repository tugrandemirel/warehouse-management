<?php

namespace App\Observers\Product\Stock;

use App\Models\ProductStock;

class ProductStockObserver
{
    /**
     * Handle the ProductStock "created" event.
     *
     * @param  \App\Models\ProductStock  $productStock
     * @return void
     */
    public function saving(ProductStock $productStock)
    {
        $productStock->description = $productStock->description ?? '-';
    }

    /**
     * Handle the ProductStock "updated" event.
     *
     * @param  \App\Models\ProductStock  $productStock
     * @return void
     */
    public function updated(ProductStock $productStock)
    {
        //
    }

    /**
     * Handle the ProductStock "deleted" event.
     *
     * @param  \App\Models\ProductStock  $productStock
     * @return void
     */
    public function deleted(ProductStock $productStock)
    {
        //
    }

    /**
     * Handle the ProductStock "restored" event.
     *
     * @param  \App\Models\ProductStock  $productStock
     * @return void
     */
    public function restored(ProductStock $productStock)
    {
        //
    }

    /**
     * Handle the ProductStock "force deleted" event.
     *
     * @param  \App\Models\ProductStock  $productStock
     * @return void
     */
    public function forceDeleted(ProductStock $productStock)
    {
        //
    }
}
