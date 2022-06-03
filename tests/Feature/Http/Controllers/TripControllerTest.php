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
            'date' => today(),
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
            'date' => today(),
        ])->make()->toArray();

        $this->json('post', route('trips.store'), $trip)
            ->assertForbidden();
    }

    public function testUserMustSeeOnlyHisTrips(): void
    {
        $this->signIn();

        Trip::factory([
            'user_id' => $this->user->id
        ])->create();

        $this->json('get', route('trips.index'))
            ->assertOk()
            ->assertJsonCount(1, 'data');

        Trip::factory()->create();

        $this->json('get', route('trips.index'))
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function testUnauthorizedUserCanNotSeeTripList(): void
    {
        $this->json('get', route('trips.index'))
            ->assertUnauthorized();
    }
}
