<?php

namespace App\Observers\Settings\Product;

use App\Models\MainConfig;

class MainConfigObserver
{
    /**
     * Handle the MainConfig "created" event.
     *
     * @param  \App\Models\MainConfig  $mainConfig
     * @return void
     */
    public function saving(MainConfig $mainConfig)
    {
        $mainConfig->user_id = auth()->user()->id;
        $stockPrefix = strtoupper(turkishCharacterChanging($mainConfig->stock_prefix));
        if (substr($mainConfig->stock_prefix, -1) != '-')
            $stockPrefix .= '-';
        $mainConfig->stock_prefix = $stockPrefix;
    }

    /**
     * Handle the MainConfig "updated" event.
     *
     * @param  \App\Models\MainConfig  $mainConfig
     * @return void
     */
    public function updated(MainConfig $mainConfig)
    {
        //
    }

    /**
     * Handle the MainConfig "deleted" event.
     *
     * @param  \App\Models\MainConfig  $mainConfig
     * @return void
     */
    public function deleted(MainConfig $mainConfig)
    {
        //
    }

    /**
     * Handle the MainConfig "restored" event.
     *
     * @param  \App\Models\MainConfig  $mainConfig
     * @return void
     */
    public function restored(MainConfig $mainConfig)
    {
        //
    }

    /**
     * Handle the MainConfig "force deleted" event.
     *
     * @param  \App\Models\MainConfig  $mainConfig
     * @return void
     */
    public function forceDeleted(MainConfig $mainConfig)
    {
        //
    }
}
