<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokedexAttack extends Model
{
    use HasFactory;


    public function pokedex()
    {
        return $this->hasMany(Pokedex::class);
    }

    public function attack()
    {
        return $this->hasMany(Attack::class);
    }
}
