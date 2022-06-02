<?php

namespace Http\Controllers;

use Tests\TestCase;

class WelcomeControllerTest extends TestCase
{
    public function testIsApplicationAlive(): void
    {
        $this->get(route('welcome'))->assertOk();
    }
}
