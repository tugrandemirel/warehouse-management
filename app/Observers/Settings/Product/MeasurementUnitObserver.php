<?php

namespace App\Observers\Settings\Product;

use App\Enum\Settings\Product\MeasurementUnit\MeasurementUnitIsDefaultEnum;
use App\Models\MeasurementUnit;

class MeasurementUnitObserver
{
    /**
     * Handle the MeasurementUnit "created" event.
     *
     * @param  \App\Models\MeasurementUnit  $measurementUnit
     * @return void
     */
    public function saving(MeasurementUnit $measurementUnit)
    {

        if ($measurementUnit->is_default == MeasurementUnitIsDefaultEnum::TRUE) {
            $measurementUnit->is_default = MeasurementUnitIsDefaultEnum::TRUE;
            MeasurementUnit::where('user_id', $measurementUnit->user_id)->update(['is_default' => false]);
        }
        else
            $measurementUnit->is_default = MeasurementUnitIsDefaultEnum::FALSE;
        $measurementUnit->user_id = auth()->user()->id;
        $measurementUnit->name = strtoupper($measurementUnit->name);
    }

    /**
     * Handle the MeasurementUnit "updated" event.
     *
     * @param  \App\Models\MeasurementUnit  $measurementUnit
     * @return void
     */
    public function updated(MeasurementUnit $measurementUnit)
    {
        //
    }

    /**
     * Handle the MeasurementUnit "deleted" event.
     *
     * @param  \App\Models\MeasurementUnit  $measurementUnit
     * @return void
     */
    public function deleted(MeasurementUnit $measurementUnit)
    {
        //
    }

    /**
     * Handle the MeasurementUnit "restored" event.
     *
     * @param  \App\Models\MeasurementUnit  $measurementUnit
     * @return void
     */
    public function restored(MeasurementUnit $measurementUnit)
    {
        //
    }

    /**
     * Handle the MeasurementUnit "force deleted" event.
     *
     * @param  \App\Models\MeasurementUnit  $measurementUnit
     * @return void
     */
    public function forceDeleted(MeasurementUnit $measurementUnit)
    {
        //
    }
}
