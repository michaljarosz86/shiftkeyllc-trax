<?php

namespace App\Models;

use App\Traits\HasLoggedUserScope;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $date
 * @property float $miles
 * @property int $car_id
 * @property Car $car
 * @property User $user
 */
class Trip extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** Scopes */
    use HasLoggedUserScope;

    protected $fillable = [
        'user_id',
        'date',
        'miles',
        'car_id',
    ];

    protected $casts = [
        'user_id' => 'int',
        'car_id' => 'int',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
