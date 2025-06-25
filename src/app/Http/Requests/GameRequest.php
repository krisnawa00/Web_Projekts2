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
 'develepor_id' => 'required',
 'description' => 'nullable',
 'price' => 'nullable|numeric',
 'year' => 'numeric',
 'image' => 'nullable|image',
 'display' => 'nullable',
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
        'image' => 'Laukā ":attribute" jāpievieno korekts attēla fails',
    ];
}

public function attributes(): array
{
    return [
        'title' => 'nosaukums',
        'develepor_id' => 'develepor',
        'description' => 'apraksts',
        'price' => 'cena',
        'release_year' => 'gads',
        'image' => 'attēls',
        'display' => 'publicēt',
    ];
}


}
