<?php

namespace App\Observers\Product\Variant;

use App\Models\VariantGroup;

class VariantGroupObserver
{
    /**
     * Handle the VariantGroup "created" event.
     *
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return void
     */
    public function saving(VariantGroup $variantGroup)
    {
        $variantGroup->user_id = auth()->user()->id;
        $variantGroup->slug = str_slug($variantGroup->name);
    }

    /**
     * Handle the VariantGroup "updated" event.
     *
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return void
     */
    public function updated(VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Handle the VariantGroup "deleted" event.
     *
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return void
     */
    public function deleted(VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Handle the VariantGroup "restored" event.
     *
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return void
     */
    public function restored(VariantGroup $variantGroup)
    {
        //
    }

    /**
     * Handle the VariantGroup "force deleted" event.
     *
     * @param  \App\Models\VariantGroup  $variantGroup
     * @return void
     */
    public function forceDeleted(VariantGroup $variantGroup)
    {
        //
    }
}
