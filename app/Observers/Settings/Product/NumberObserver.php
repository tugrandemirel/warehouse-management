<?php

namespace App\Observers\Settings\Product;

use App\Models\Number;

class NumberObserver
{
    /**
     * Handle the Number "created" event.
     *
     * @param  \App\Models\Number  $number
     * @return void
     */
    public function saving(Number $number)
    {
        $number->user_id = auth()->user()->id;
    }

    /**
     * Handle the Number "updated" event.
     *
     * @param  \App\Models\Number  $number
     * @return void
     */
    public function updated(Number $number)
    {
        //
    }

    /**
     * Handle the Number "deleted" event.
     *
     * @param  \App\Models\Number  $number
     * @return void
     */
    public function deleted(Number $number)
    {
        //
    }

    /**
     * Handle the Number "restored" event.
     *
     * @param  \App\Models\Number  $number
     * @return void
     */
    public function restored(Number $number)
    {
        //
    }

    /**
     * Handle the Number "force deleted" event.
     *
     * @param  \App\Models\Number  $number
     * @return void
     */
    public function forceDeleted(Number $number)
    {
        //
    }
}
