<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function pokedex()
    {
        return $this->hasMany(Pokemon::class);
    }

    public function attack()
    {
        return $this->hasMany(Attack::class);
    }

    public function color()
    {
        return $this->hasOne(Color::class, 'name', 'name');
    }
}
