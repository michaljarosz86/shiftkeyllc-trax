<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'year' => ['required', 'integer', 'max:' . today()->year],
            'make' => ['required', 'string'],
            'model' => ['required', 'string'],
            'trip_count' => 'required',
            'trip_miles' => 'required',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'trip_count' => 0,
            'trip_miles' => 0,
            'user_id' => auth()->id(),
        ]);
    }
}
