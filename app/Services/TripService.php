<?php

namespace App\Services;

use App\Http\Requests\TripStoreRequest;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TripService
{
    public static function store(TripStoreRequest $request): Trip
    {
        return DB::transaction(static function () use ($request) {
            $validated = array_merge(
                $request->validated(),
                ['date' => Carbon::parse($request->validated('date'))->toDateString()]
            );

            $trip = Trip::create($validated);
            $car = $trip->car;

            /**
             * We can use observers to update the car's mileage
             * TripObserver::class
             * that is a better way because to implement all CRUD actions in one place
             */
            $car->update([
                'trip_count' => $car->trip_count + 1,
                'trip_miles' => $car->trip_miles + $trip->miles,
            ]);

            return $trip;
        });
    }
}
