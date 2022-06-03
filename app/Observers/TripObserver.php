<?php

namespace App\Observers;

use App\Models\Trip;

class TripObserver
{
    public function created(Trip $trip): void
    {
        //
    }


    public function updated(Trip $trip)
    {
        //
    }

    /**
     * Handle the Trip "deleted" event.
     *
     * @param  \App\Models\Trip  $trip
     * @return void
     */
    public function deleted(Trip $trip)
    {
        //
    }

    /**
     * Handle the Trip "restored" event.
     *
     * @param  \App\Models\Trip  $trip
     * @return void
     */
    public function restored(Trip $trip)
    {
        //
    }

    /**
     * Handle the Trip "force deleted" event.
     *
     * @param  \App\Models\Trip  $trip
     * @return void
     */
    public function forceDeleted(Trip $trip)
    {
        //
    }
}
