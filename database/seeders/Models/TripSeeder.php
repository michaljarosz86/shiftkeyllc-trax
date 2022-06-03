<?php

namespace Database\Seeders\Models;

use App\Models\Car;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create();

        Trip::factory()
            ->count(10)
            ->for($user)
            ->has(Car::factory()->count(3))
            ->create();
    }
}
