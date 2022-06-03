<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function index(): CarCollection
    {
        return new CarCollection(Car::where('user_id', auth()->id())->get());
    }

    public function show(Car $car): CarResource
    {
        $this->authorize('show', $car);

        return new CarResource($car);
    }

    public function store(CarStoreRequest $request): JsonResponse
    {
        $car = Car::create($request->validated());

        return response()->json($car, 201);
    }

    public function destroy(Car $car): JsonResponse
    {
        $this->authorize('destroy', $car);

        $car->delete();

        return response()->json(null, 204);
    }
}
