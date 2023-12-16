<?php

namespace App\Observers\Product\Stock;

use App\Enum\Product\Stock\StockStatusEnum;
use App\Models\Stock;

class StockObserver
{
    /**
     * Handle the Stock "created" event.
     *
     * @param  \App\Models\Stock  $stock
     * @return void
     */
    public function saving(Stock $stock)
    {
        $stock->user_id = auth()->user()->id;
        $stock->status = StockStatusEnum::ADD;
    }

    /**
     * Handle the Stock "updated" event.
     *
     * @param  \App\Models\Stock  $stock
     * @return void
     */
    public function updated(Stock $stock)
    {
        //
    }

    /**
     * Handle the Stock "deleted" event.
     *
     * @param  \App\Models\Stock  $stock
     * @return void
     */
    public function deleted(Stock $stock)
    {
        $stock->productStocks()->delete();
    }

    /**
     * Handle the Stock "restored" event.
     *
     * @param  \App\Models\Stock  $stock
     * @return void
     */
    public function restored(Stock $stock)
    {
        //
    }

    /**
     * Handle the Stock "force deleted" event.
     *
     * @param  \App\Models\Stock  $stock
     * @return void
     */
    public function forceDeleted(Stock $stock)
    {
        //
    }
}
