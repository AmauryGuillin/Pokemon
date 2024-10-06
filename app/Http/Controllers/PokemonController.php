<?php

namespace App\Http\Controllers;

use App\Models\Pokedex;
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
        //retreive all 1st gen Pokemon links 
        // $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=151&offset=0');
        // $pokemons = $response->json();

        // Get all pokemon
        $pokemons = Pokedex::all();

        return Inertia::render('Dashboard', ['pokemons' => $pokemons]);
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
        $pokemonSelected = Pokedex::where('name', $id)->first();

        if (!$pokemonSelected) {
            return redirect()->route('pokedex.index')->with('error', 'Le Pokémon demandé n\'existe pas.');
        }

        return Inertia::render('Pokedex/SinglePokemon', ['pokemon' => $pokemonSelected]);
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
