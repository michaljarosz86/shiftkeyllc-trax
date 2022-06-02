<?php

namespace Http\Controllers;

use App\Models\Car;
use App\Models\Trip;
use Tests\TestCase;

class TripControllerTest extends TestCase
{
    public function testUserCanStoreTripWithOwnCar(): void
    {
        $this->signIn();

        /** @var Car $car */
        $car = Car::factory()->create([
            'user_id' => $this->user->id
        ]);

        $trip = Trip::factory([
            'user_id' => $this->user->id,
            'car_id' => $car->id,
            'date' => now()->format('Y/m/d'),
        ])->make()->toArray();

        $this->json('post', route('trips.store'), $trip)
            ->assertStatus(201);

        $this->assertDatabaseHas('trips', [
            'user_id' => $this->user->id,
            'car_id' => $car->id,
        ]);
    }

    public function testUserCanNotStoreTripWithOtherCars(): void
    {
        $this->signIn();

        $trip = Trip::factory([
            'user_id' => $this->user->id,
            'date' => now()->format('Y/m/d'),
        ])->make()->toArray();

        $this->json('post', route('trips.store'), $trip)
            ->assertForbidden();
    }
}
