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
        ];
    }
}
