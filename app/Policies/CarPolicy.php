<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Car $car): bool
    {
        return $user->id === $car->user_id;
    }
}
