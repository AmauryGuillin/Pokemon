<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
{
    use HasFactory;

    public function typesPrime()
    {
        return $this->belongsTo(Type::class);
    }

    public function typesSecond()
    {
        return $this->belongsTo(Type::class);
    }

    public function attack()
    {
        return $this->hasMany(PokedexAttack::class);
    }
}
