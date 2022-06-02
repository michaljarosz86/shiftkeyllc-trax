<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    public function testCanLoggedUserSeeHomePage(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('home'))
            ->assertOk();
    }

    public function testIsHomePageGuarded(): void
    {
        $this->get(route('home'))->assertRedirect();
    }
}
