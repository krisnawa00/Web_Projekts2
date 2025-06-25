<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:256',
            'develepor_id' => 'required|exists:develepors,id',
            'genre_id' => 'nullable|exists:genres,id',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'release_year' => 'required|numeric|digits:4',
            'image' => 'nullable|url',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Lauks ":attribute" ir obligāts',
            'min' => 'Laukam ":attribute" jābūt vismaz :min simbolus garam',
            'max' => 'Lauks ":attribute" nedrīkst būt garāks par :max simboliem',
            'boolean' => 'Lauka ":attribute" vērtībai jābūt "true" vai "false"',
            'unique' => 'Šāda lauka ":attribute" vērtība jau ir reģistrēta',
            'numeric' => 'Lauka ":attribute" vērtībai jābūt skaitlim',
            'url' => 'Lauks ":attribute" jābūt derīgai URL adresei',
            'exists' => 'Izvēlētais ":attribute" nav derīgs',
            'digits' => 'Lauks ":attribute" jābūt precīzi :digits cipariem garš',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'nosaukums',
            'develepor_id' => 'develepor',
            'genre_id' => 'žanrs',
            'description' => 'apraksts',
            'price' => 'cena',
            'release_year' => 'gads',
            'image' => 'attēls',
            'is_active' => 'publicēt',
        ];
    }
}
