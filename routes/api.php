<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\TripController;
use Illuminate\Http\Request;

Route::middleware('auth:api')->group(function () {
    Route::get('/user', static function (Request $request) {
        return $request->user();
    });

    Route::resource('cars', CarController::class)
        ->only(['store', 'destroy', 'index']);

    Route::get('cars/{car}', [CarController::class, 'show'])
        ->name('cars.show')
        ->withTrashed();

    Route::resource('trips', TripController::class)
        ->only(['store', 'index']);
});
