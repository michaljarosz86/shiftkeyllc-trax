<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $make
 * @property string $model
 * @property int $year
 * @property int $trip_count
 * @property float $trip_miles
 * @property User $user
 */
class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year',
        'trip_count',
        'trip_miles',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
