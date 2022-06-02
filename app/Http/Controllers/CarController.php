<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Http\Resources\CarCollection;
use App\Models\Car;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function index(): CarCollection
    {
        return new CarCollection(Car::where('user_id', auth()->id())->get());
    }

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
