<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokedexAttack extends Model
{
    use HasFactory;


    public function pokedex()
    {
        return $this->belongsTo(Pokedex::class);
    }

    public function attack()
    {
        return $this->belongsTo(Attack::class);
    }
}
