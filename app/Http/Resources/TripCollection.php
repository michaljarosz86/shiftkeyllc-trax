<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TripCollection extends ResourceCollection
{
    private float $totalMiles;

    public function __construct($resource)
    {
        parent::__construct($resource);

        $this->totalMiles = $this->resource->sum('miles');
    }

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->map(function ($trip) {
                return [
                    'id' => $trip->id,
                    'date' => $trip->date,
                    'miles' => $trip->miles,
                    'total' => $this->totalMiles,
                    'car' => $trip->car,
                ];
            }),
        ];
    }
}
