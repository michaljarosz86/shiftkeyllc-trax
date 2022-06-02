<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Models\UserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.pl',
            'password' => Hash::make('admin'),
        ]);

        $this->call(UserSeeder::class);
    }
}
