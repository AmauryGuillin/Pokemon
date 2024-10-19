<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonAttack extends Model
{
    use HasFactory;


    public function pokedex()
    {
        return $this->belongsTo(Pokemon::class);
    }

    public function attack()
    {
        return $this->belongsTo(Attack::class);
    }
}
