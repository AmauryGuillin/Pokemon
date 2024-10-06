<?php

namespace App\Http\Controllers;

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
        $response = Http::get('https://pokeapi.co/api/v2/pokemon?limit=151&offset=0');
        $pokemons = $response->json();

        return Inertia::render('Dashboard', ['pokemons' => $pokemons['results']]);
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
        //get the selected pokemon
        $response = Http::get('https://pokeapi.co/api/v2/pokemon/' . $id);
        $pokemon = $response->json();

        $resp = Http::get('https://pokeapi.co/api/v2/pokemon-species/' . $id);
        $pkmnDescriptionResp = $resp->json();

        //Format description
        $pkmnDescriptionUnformatted = (string) $pkmnDescriptionResp["flavor_text_entries"][0]["flavor_text"];
        $pkmnDescriptionformatted = str_replace(["\n", "\f"], ' ', $pkmnDescriptionUnformatted);
        $pkmnDescriptionformatted = preg_replace('/\s+/', ' ', $pkmnDescriptionUnformatted);

        return Inertia::render('Pokedex/SinglePokemon', ['pokemon' => $pokemon, 'pkmnDescription' => $pkmnDescriptionformatted]);
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
