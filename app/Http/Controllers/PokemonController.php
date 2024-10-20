<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Pokemon;
use App\Models\PokemonAttack;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

use function Pest\Laravel\get;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Get all pokémon
        $allPokemons = Pokemon::all()->load(['typePrime', 'typePrime.color', 'typeSecond', 'typeSecond.color']);
        $allTypes = Type::all()->load('color');
        return Inertia::render('Pokedex/Pokedex', ['pokemons' => $allPokemons, 'types' => $allTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {

        $pokemonSelected = Pokemon::with(['typePrime.color', 'typeSecond.color', 'evolveFrom', 'evolveTo'])
            ->where('name', $id)->first();

        if (!$pokemonSelected) {
            return redirect()->route('pokedex')->with('error', 'Le Pokémon demandé n\'existe pas.');
        }

        $objects = [];

        $objects['typePrimeColor'] = $pokemonSelected->typePrime->color->value;
        $objects['typePrime'] = $pokemonSelected->typePrime->name;

        $objects['typeSecondColor'] = $pokemonSelected->typeSecond->color->value ?? null;
        $objects['typeSecond'] = $pokemonSelected->typeSecond->name ?? null;

        $attacks = [];

        $displayedAttacks = PokemonAttack::where('pokemon_id', $pokemonSelected->id)->with('attack')->take(2)->get();

        $attacks['attack_one'] = $displayedAttacks[0]['attack']['name'];
        $attacks['attack_two'] = $displayedAttacks[1]['attack']['name'];
        $objects['attackNames'] = $attacks;


        return Inertia::render('Pokedex/SinglePokemon', ['pokemon' => $pokemonSelected, 'objects' => $objects]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
