<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class CarController extends Controller
{
    public function store(CarStoreRequest $request): Model|Car
    {
        return Car::create($request->validated());
    }
}
