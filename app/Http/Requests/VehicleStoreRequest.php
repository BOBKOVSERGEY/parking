<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'plate_number' => 'required',
            'description'  => [
                'nullable',
                'max:255'
            ]
        ];
    }
}
