<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => (bool) $this->is_active,
            // no game relation here
        ];
    }
}