<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'make' => $this->faker->word(),
            'model' => $this->faker->word(),
            'year' => $this->faker->year(),
            'trip_count' => $this->faker->numberBetween(),
            'trip_miles' => $this->faker->randomFloat(2, 0, 1000),
            'deleted_at' => null,
        ];
    }
}
