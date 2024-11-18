<?php

namespace App\Http\Controllers;

use App\Models\Attack;
use App\Models\Pokemon;
use App\Models\PokemonAttack;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $pokemonName)
    {
        //$pokemonAllAttacks = Pokemon::with(['attacks'])->where('number', $pokemonID)->first();
        $pokemon = Pokemon::where('name', $pokemonName)->with('typePrime.color')->first();
        $pokemonAllAttacks = PokemonAttack::where('pokemon_id', $pokemon['id'])->with(['attack.type.color'])->get()->pluck('attack');
        //dd($pokemonAllAttacks);
        return Inertia::render('Attack/Attacks', ['attacks' => $pokemonAllAttacks, 'pokemon' => $pokemon]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attack $attack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attack $attack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attack $attack)
    {
        //
    }
}
