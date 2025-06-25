<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust authorization as needed, true allows everyone
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nosaukums',
            'description' => 'apraksts',
            'is_active' => 'aktīvs',
        ];
    }
}
