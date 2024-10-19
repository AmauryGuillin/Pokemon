<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Pokemon;
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


        $objects['evolutions'] = $this->getEvolutionChain($pokemonSelected);


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

    public function getEvolutionChain($selectedPokemon)
    {
        $evolutions = [
            'first' => null,
            'middle' => null,
            'last' => null,
        ];

        if (!$selectedPokemon->evolve_from) {
            $evolutions['first'] = $selectedPokemon;
        } else {
            $evolveFirst = Pokemon::where('name', $selectedPokemon->evolve_from)->first();
            $evolutions['first'] = $evolveFirst;
            if ($evolveFirst && !$evolveFirst->evolve_from) {
                $evolutions['middle'] = $selectedPokemon;
            }
        }

        if ($selectedPokemon->evolve_to) {
            $evolutions['middle'] = $selectedPokemon;
            $evolveTo = Pokemon::where('name', $selectedPokemon->evolve_to)->first();
            if ($evolveTo) {
                $evolutions['last'] = $evolveTo;
            }
        } else if (!$evolutions['middle']) {
            $evolutions['middle'] = $selectedPokemon;
        }

        if (!$selectedPokemon->evolve_to) {
            $evolutions['last'] = $selectedPokemon;
        }

        return $evolutions;
    }
}
