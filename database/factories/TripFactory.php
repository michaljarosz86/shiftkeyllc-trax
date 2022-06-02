<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'date' => $this->faker->date('Y/m/d'),
            'miles' => $this->faker->randomFloat(2, 0, 300),
            'car_id' => Car::factory(),
        ];
    }
}
