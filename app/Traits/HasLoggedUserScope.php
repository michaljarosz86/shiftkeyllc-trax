<?php

namespace App\Traits;

trait HasLoggedUserScope
{
    public function scopeLoggedUser($query)
    {
        return $this->where('user_id', auth()->id());
    }
}
