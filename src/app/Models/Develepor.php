<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Develepor extends Model
{
    protected $table = 'develepors'; 
    
    protected $fillable = ['name', 'email'];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}

