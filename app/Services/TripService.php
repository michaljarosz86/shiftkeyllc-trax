<?php

namespace App\Services;

use App\Http\Requests\TripStoreRequest;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TripService
{
    /** over-engineering, too little operation in the method  */
    public static function store(TripStoreRequest $request): Trip
    {
        return DB::transaction(static function () use ($request) {
            $validated = array_merge(
                $request->validated(),
                ['date' => Carbon::parse($request->validated('date'))->toDateString()]
            );

            return Trip::create($validated);
        });
    }
}
