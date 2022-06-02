<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function store(CarStoreRequest $request): Model|Car
    {
        return Car::create($request->validated());
    }

    public function destroy(Car $car): JsonResponse
    {
        $this->authorize('destroy', $car);

        $car->delete();

        return response()->json(null, 204);
    }
}
