<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    protected User $user;

    protected function signIn(User $user = null): void
    {
        $this->user = $user ?: User::factory()->create();

        $this->actingAs($this->user, 'api');
    }
}
