<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\PokemonAttack;
use App\Models\Type;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all pokémon
        $allPokemons = Pokemon::orderBy('id')->get()->load(['typePrime', 'typePrime.color', 'typeSecond', 'typeSecond.color']);
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
        $allAttacks = PokemonAttack::where('pokemon_id', $pokemonSelected->id)->with('attack.type.color')->get();

        $attacks['attack_one'] = $displayedAttacks[0]['attack']['name'];
        $attacks['attack_two'] = $displayedAttacks[1]['attack']['name'];
        $objects['attackNames'] = $attacks;

        $attackList = [];
        foreach ($allAttacks as $attack) {
            array_push($attackList, $attack['attack']);
        }

        $objects['allAttacks'] = $attackList;

        // Get evolutions
        $evolutions = $this->evolutionsFinder($pokemonSelected);
        $objects['evolutions'] = $evolutions;

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

    private function evolutionsFinder(Pokemon $input): array
    {
        $evolutionChain = [];
        $evolutionChain[] = $input;

        if ($input['number'] === 133) {
            $evoliEvolutionChain = [134, 135, 136];
            $tmpEvolutionChain = Pokemon::whereIn('number', $evoliEvolutionChain)->get();

            foreach ($tmpEvolutionChain as $pokemon) {
                array_push($evolutionChain, $pokemon);
            }

            return $evolutionChain;
        }

        if ($input['evolve_from']) {

            $pokemonBefore = $input;

            while ($pokemonBefore['evolve_from']) {
                $pokemonBefore = Pokemon::where('name', $pokemonBefore['evolve_from'])->first();
                array_unshift($evolutionChain, $pokemonBefore);
            }
        }

        if ($input['evolve_to']) {

            $pokemonAfter = $input;

            while ($pokemonAfter['evolve_to']) {
                $pokemonAfter = Pokemon::where('name', $pokemonAfter['evolve_to'])->first();
                array_push($evolutionChain, $pokemonAfter);
            }
        }

        return $evolutionChain;
    }
}
