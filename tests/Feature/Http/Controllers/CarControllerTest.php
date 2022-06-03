<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Car;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    public function testUserCanStoreNewCar(): void
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
        ]);
    }

    public function testUnauthorizedUserCanNotStoreNewCar(): void
    {
        $car = Car::factory()->make()->toArray();

        $this->json('post', route('cars.store'), $car)
            ->assertUnauthorized();
    }

    public function testUserCanDeleteOwnCar(): void
    {
        $this->signIn();

        /** @var Car $car */
        $car = Car::factory([
            'user_id' => $this->user->id
        ])->create();

        $this->json('delete', route('cars.destroy', ['car' => $car]))->assertStatus(204);

        $this->assertSoftDeleted('cars', [
            'id' => $car->id
        ]);
    }

    public function testUserCanNotDeleteRandomCar(): void
    {
        $this->signIn();

        /** @var Car $car */
        $car = Car::factory()->create();

        $this->json('delete', route('cars.destroy', ['car' => $car]))
            ->assertForbidden();

        $this->assertNotSoftDeleted('cars', [
            'id' => $car->id
        ]);
    }

    public function testUserCanSeeAllHisCars(): void
    {
        $this->signIn();

        $this->json('get', route('cars.index'))
            ->assertOk()
            ->assertJsonCount(0, 'data');

        Car::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->json('get', route('cars.index'))
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function testUserCanNotSeeOtherCars(): void
    {
        $this->signIn();

        $this->json('get', route('cars.index'))
            ->assertOk()
            ->assertJsonCount(0, 'data');

        Car::factory()->create();

        $this->json('get', route('cars.index'))
            ->assertOk()
            ->assertJsonCount(0, 'data');
    }

    public function testUserCanSeeOwnCarDetails(): void
    {
        $this->signIn();

        /** @var Car $car */
        $car = Car::factory([
            'user_id' => $this->user->id
        ])->create();

        $this->json('get', route('cars.show', ['car' => $car]))
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'make' => $car->make,
                    'model' => $car->model,
                    'year' => $car->year,
                    'trip_count' => $car->trip_count,
                    'trip_miles' => $car->trip_miles,
                ]
            ]);
    }

    public function testUserCanNotSeeOtherCarsDetails(): void
    {
        $this->signIn();

        /** @var Car $car */
        $car = Car::factory()->create();

        $this->json('get', route('cars.show', ['car' => $car]))->assertForbidden();
    }

    public function testUserCanSeeDeletedCarDetails(): void
    {
        $this->signIn();

        /** @var Car $car */
        $car = Car::factory([
            'user_id' => $this->user->id
        ])->create();

        $car->delete();

        $this->json('get', route('cars.show', ['car' => $car]))
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'make' => $car->make,
                    'model' => $car->model,
                    'year' => $car->year,
                    'trip_count' => $car->trip_count,
                    'trip_miles' => $car->trip_miles,
                ]
            ]);
    }
}
