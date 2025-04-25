<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Develepor extends Model
{
    
    protected $table = 'develepors'; 
    
    protected $fillable = ['name', 'email']; 
}
