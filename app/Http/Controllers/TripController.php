<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripStoreRequest;
use App\Http\Resources\TripCollection;
use App\Models\Car;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    public function index(): TripCollection
    {
        $trips = Trip::query()
            ->where('user_id', auth()->id())
            ->with('car:id,make,model,year')
            ->get();

        return new TripCollection($trips);
    }

    public function store(TripStoreRequest $request): JsonResponse
    {
        $car = Car::query()
            ->where('id', $request->get('car_id'))
            ->first();

        $this->authorize('tripStore', $car);

        $validated = array_merge(
            $request->validated(),
            ['date' => Carbon::parse($request->validated('date'))->toDateString()]
        );

        $trip = Trip::create($validated);

        return response()->json($trip, 201);
    }
}
