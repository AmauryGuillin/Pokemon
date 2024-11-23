<?php

namespace App\Utils;

use App\Models\Pokemon;

class Utils
{
    public static function evolutionsFinder(Pokemon $input): array
    {
        $evolutionChain = [];
        $evolutionChain[] = $input;

        if ($input['number'] === 133) {
            $evoliEvolutionChain = [134, 135, 136];
            $tmpEvolutionChain = Pokemon::with('typePrime.color', 'typeSecond.color')->whereIn('number', $evoliEvolutionChain)->get();

            foreach ($tmpEvolutionChain as $pokemon) {
                array_push($evolutionChain, $pokemon);
            }

            return $evolutionChain;
        }

        if ($input['evolve_from']) {

            $pokemonBefore = $input;

            while ($pokemonBefore['evolve_from']) {
                $pokemonBefore = Pokemon::with('typePrime.color', 'typeSecond.color')->where('name', $pokemonBefore['evolve_from'])->first();
                array_unshift($evolutionChain, $pokemonBefore);
            }
        }

        if ($input['evolve_to']) {

            $pokemonAfter = $input;

            while ($pokemonAfter['evolve_to']) {
                $pokemonAfter = Pokemon::with('typePrime.color', 'typeSecond.color')->where('name', $pokemonAfter['evolve_to'])->first();
                array_push($evolutionChain, $pokemonAfter);
            }
        }

        return $evolutionChain;
    }
}
