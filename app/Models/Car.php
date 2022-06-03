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
 * @property string $make
 * @property string $model
 * @property int $year
 * @property int $trip_count
 * @property float $trip_miles
 * @property User $user
 *
 * @method loggedUser()
 */
class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** Scopes */
    use HasLoggedUserScope;

    protected $fillable = [
        'user_id',
        'make',
        'model',
        'year',
        'trip_count',
        'trip_miles',
    ];

    protected $casts = [
        'user_id' => 'int',
        'year' => 'int',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
