<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{

protected $fillable = [
'name',
'develepor_id',
'description',
'price',
'year',
];

public function develepor(): BelongsTo
{
 return $this->belongsTo(Develepor::class);
 return $this->hasMany(Genre::class);
}

public function genre(): BelongsTo
{
    return $this->belongsTo(Genre::class);
}
public function jsonSerialize(): mixed
{
    return [
        'id' => intval($this->id),
        'name' => $this->name,
        'description' => $this->description,
        'develepor' => $this->develepor->name ?? '',
        'genre' => $this->genre->name ?? '',
        'price' => number_format($this->price, 2),
        'year' => intval($this->year),
        'image' => $this->image ? asset('images/' . $this->image) : null,
    ];
}



}
