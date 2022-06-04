<?php

namespace Observers;

use App\Models\Car;
use App\Models\Trip;
use Tests\TestCase;

class TripObserverTest extends TestCase
{
    public function testCreatedObserver(): void
    {
        $this->signIn();

        /** @var Car $car */
        $car = Car::factory([
            'user_id' => $this->user->id,
            'trip_count' => 0,
            'trip_miles' => 0,
        ])->create();

        Trip::factory([
            'user_id' => $this->user->id,
            'car_id' => $car->id,
            'miles' => 100
        ])->create();

        $car = $car->fresh();
        $this->assertEquals(1, $car->trip_count);
        $this->assertEquals(100, $car->trip_miles);

        Trip::factory([
            'user_id' => $this->user->id,
            'car_id' => $car->id,
            'miles' => 100
        ])->create();

        $car = $car->fresh();
        $this->assertEquals(2, $car->trip_count);
        $this->assertEquals(200, $car->trip_miles);
    }
}
