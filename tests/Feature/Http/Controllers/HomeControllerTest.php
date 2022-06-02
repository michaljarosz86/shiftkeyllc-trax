<?php

namespace Http\Controllers;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testCanLoggedUserSeeHomePage(): void
    {
        $this->signIn();

        $this->actingAs($this->user)
            ->get(route('home'))
            ->assertOk();
    }

    public function testIsHomePageGuarded(): void
    {
        $this->get(route('home'))->assertRedirect();
    }
}
