<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resistances extends Model
{
    use HasFactory;

    function pokemon(){
        return $this->belongsTo(Pokemon::class);
    }
}
