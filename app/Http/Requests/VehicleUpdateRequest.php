<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'plate_number' => 'required',
            'description' => 'nullable|max:255'
        ];
    }
}
