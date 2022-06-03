<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TripCollection extends ResourceCollection
{
    /** #TODO count total field */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($trip) {
                return [
                    'id' => $trip->id,
                    'date' => $trip->date,
                    'miles' => $trip->miles,
                    'total' => $trip->miles,
                    'car' => $trip->car,
                ];
            }),
        ];
    }
}
