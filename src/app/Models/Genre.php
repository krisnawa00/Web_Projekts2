<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Genre extends Model
{
    protected $fillable = [
        'game_id',
        'name',
        'description',
        'is_active',
    ];

    // Žanrs pieder pie spēles

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'is_active' => (bool) $this->is_active,
            'game' => $this->game->name ?? '',
        ];
    }
}