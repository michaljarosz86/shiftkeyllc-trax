<?php

namespace Database\Seeders\Models;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create();
        Car::factory()
            ->count(10)
            ->for($user)
            ->create();
    }
}
