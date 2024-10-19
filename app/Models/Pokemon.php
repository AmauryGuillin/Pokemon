<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    public function typePrime()
    {
        return $this->belongsTo(Type::class, 'type_prime_id');
    }

    public function typeSecond()
    {
        return $this->belongsTo(Type::class, 'type_second_id');
    }

    // Relation many-to-many avec Attack via la table pivot 'pokemon_attacks'
    public function attacks()
    {
        return $this->belongsToMany(Attack::class, 'pokemon_attacks')->withTimestamps();
    }

    public function evolveFrom()
    {
        return $this->belongsTo(Pokemon::class, 'evolve_from', 'name');
    }

    public function evolveTo()
    {
        return $this->hasOne(Pokemon::class, 'name', 'evolve_to');
    }

}
