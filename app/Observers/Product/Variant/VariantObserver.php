<?php

namespace App\Observers\Product\Variant;

use App\Models\Variant;

class VariantObserver
{
    /**
     * Handle the Variant "created" event.
     *
     * @param  \App\Models\Variant  $variant
     * @return void
     */
    public function saving(Variant $variant)
    {
        $variant->name = ucwords(strtolower($variant->name));
        $variant->user_id = auth()->user()->id;
        $variant->slug = str_slug($variant->name);
    }

    /**
     * Handle the Variant "updated" event.
     *
     * @param  \App\Models\Variant  $variant
     * @return void
     */
    public function updated(Variant $variant)
    {
        //
    }

    /**
     * Handle the Variant "deleted" event.
     *
     * @param  \App\Models\Variant  $variant
     * @return void
     */
    public function deleted(Variant $variant)
    {
        //
    }

    /**
     * Handle the Variant "restored" event.
     *
     * @param  \App\Models\Variant  $variant
     * @return void
     */
    public function restored(Variant $variant)
    {
        //
    }

    /**
     * Handle the Variant "force deleted" event.
     *
     * @param  \App\Models\Variant  $variant
     * @return void
     */
    public function forceDeleted(Variant $variant)
    {
        //
    }
}
