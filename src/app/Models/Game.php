<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $fillable = [
        'title',
        'develepor_id',
        'genre_id',
        'description',
        'price',
        'release_year',
        'image',     // this will store a URL string now
        'is_active',
    ];

    public function develepor(): BelongsTo
    {
        return $this->belongsTo(Develepor::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'title' => $this->title,
            'description' => $this->description,
            'develepor' => $this->develepor->name ?? '',
            'genre' => $this->genre->name ?? '',
            'price' => number_format($this->price, 2),
            'year' => intval($this->release_year),
            'image' => $this->image ?: null,
        ];
    }
}

