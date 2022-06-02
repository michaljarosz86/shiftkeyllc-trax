<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Car;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    public function testCanUserStoreNewCar(): void
    {
        $this->signIn();

        $car = Car::factory([
            'user_id' => $this->user->id
        ])->make()->toArray();


        $this->json('post', route('cars.store'), $car)
            ->assertStatus(201);

        $this->assertDatabaseHas('cars', [
            'user_id' => $this->user->id,
            'year' => $car['year'],
            'make' => $car['make'],
            'model' => $car['model'],
            'trip_count' => 0,
            'trip_miles' => 0
        ]);
    }

    public function testCanUnauthorizedUserStoreNewCar(): void
    {
        $car = Car::factory()->make()->toArray();

        $this->json('post', route('cars.store'), $car)
            ->assertUnauthorized();
    }
}
