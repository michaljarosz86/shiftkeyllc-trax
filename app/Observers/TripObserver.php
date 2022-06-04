<?php

namespace App\Observers;

use App\Models\Trip;

class TripObserver
{
    public bool $afterCommit = true;

    public function created(Trip $trip): void
    {
        $trip->car->update([
            'trip_count' => $trip->car->trip_count + 1,
            'trip_miles' => $trip->car->trip_miles + $trip->miles,
        ]);
    }
}
