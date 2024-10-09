<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokedex extends Model
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

    // Relations de faiblesses
    public function weaknessPrime()
    {
        return $this->belongsTo(Type::class, 'weakness_prime_id');
    }

    public function weaknessSecond()
    {
        return $this->belongsTo(Type::class, 'weakness_second_id');
    }

    public function weaknessTertiary()
    {
        return $this->belongsTo(Type::class, 'weakness_tertiary_id');
    }

    public function weaknessFourth()
    {
        return $this->belongsTo(Type::class, 'weakness_fourth_id');
    }

    public function weaknessFifth()
    {
        return $this->belongsTo(Type::class, 'weakness_fifth_id');
    }

    public function weaknessSixth()
    {
        return $this->belongsTo(Type::class, 'weakness_sixth_id');
    }

    // Relations de forces
    public function strengthPrime()
    {
        return $this->belongsTo(Type::class, 'strength_prime_id');
    }

    public function strengthSecond()
    {
        return $this->belongsTo(Type::class, 'strength_second_id');
    }

    public function strengthTertiary()
    {
        return $this->belongsTo(Type::class, 'strength_tertiary_id');
    }

    public function strengthFourth()
    {
        return $this->belongsTo(Type::class, 'strength_fourth_id');
    }

    public function strengthFifth()
    {
        return $this->belongsTo(Type::class, 'strength_fifth_id');
    }

    public function strengthSixth()
    {
        return $this->belongsTo(Type::class, 'strength_sixth_id');
    }

    // Relation many-to-many avec Attack via la table pivot 'pokedex_attacks'
    public function attacks()
    {
        return $this->belongsToMany(Attack::class, 'pokedex_attacks')->withTimestamps();
    }
}
