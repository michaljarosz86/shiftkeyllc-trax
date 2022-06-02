<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripStoreRequest;
use App\Models\Car;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    public function store(TripStoreRequest $request): JsonResponse
    {
        $car = Car::query()
            ->where('id', $request->get('car_id'))
            ->first();

        $this->authorize('tripStore', $car);

        $trip = Trip::create($request->validated());

        return response()->json($trip, 201);
    }
}
