<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomePageTest extends TestCase
{
    public function testIsApplicationAlive(): void
    {
        $response = $this->get(route('welcome'));

        $response->assertStatus(200);
    }
}
