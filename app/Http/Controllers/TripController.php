<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripStoreRequest;
use App\Http\Resources\TripCollection;
use App\Models\Car;
use App\Models\Trip;
use App\Services\TripService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    public function index(): TripCollection
    {
        $trips = Trip::query()
            ->loggedUser()
            ->with('car:id,make,model,year')
            ->get();

        return new TripCollection($trips);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(TripStoreRequest $request): JsonResponse
    {
        $car = Car::query()
            ->where('id', $request->get('car_id'))
            ->first();

        $this->authorize('tripStore', $car);

        return response()->json(TripService::store($request), 201);
    }
}
