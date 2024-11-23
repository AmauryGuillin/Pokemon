<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Utils\Utils;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Termwind\render;

class EvolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $selectedPokemonName)
    {
        $selectedPokemon = Pokemon::with('typePrime.color', 'typeSecond.color')->where('name', $selectedPokemonName)->first();
        $evolutions = Utils::evolutionsFinder($selectedPokemon);

        return Inertia::render('Evolutions/Evolutions', ['pokemon' => $selectedPokemon, 'evolutionList' => $evolutions]);
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
