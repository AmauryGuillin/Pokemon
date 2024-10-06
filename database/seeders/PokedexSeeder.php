<?php

namespace Database\Seeders;

use App\Models\Pokedex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PokedexSeeder extends Seeder
{

    private const LANGUAGE = 'fr';

    /**
     * Convert a number from one unit to another (e.g., decimeters to meters).
     */
    private function convertNumber(int $value, string $from, string $to): float
    {
        $const['dm'] = 10; // decimetre
        $const['m'] = 1; // metre
        $const['dg'] = 1000; // decigramme
        $const['kg'] = 100; // kilogramme

        if (!array_key_exists($from, $const) || !array_key_exists($to, $const)) return 0;

        return $value * $const[$to] / $const[$from];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        for ($i = 1; $i <= 151; $i++) {

            $pokedexModel = new Pokedex();

            // Get the attack from POKéAPI
            $responsePokemon = Http::get('https://pokeapi.co/api/v2/pokemon/' . $i);
            $pokemon = $responsePokemon->json();

            // number
            $pokedexModel->number = $pokemon['order'];

            // image_artwork
            $pokedexModel->image_artwork = $pokemon['sprites']['other']['official-artwork']['front_default'];

            // image_front
            $pokedexModel->image_front = $pokemon['sprites']['front_default'];

            // image_back
            $pokedexModel->image_back = $pokemon['sprites']['back_default'];

            // height
            $heightUnformatted = $pokemon['height'];
            $pokedexModel->height = $this->convertNumber($heightUnformatted, 'dm', 'm');


            // weight
            $weightUnformatted = $pokemon['weight'];
            $pokedexModel->weight = $this->convertNumber($weightUnformatted, 'dg', 'kg');

            // cry
            $pokedexModel->cry = $pokemon['cries']['legacy'];

            // stats
            foreach ($pokemon["stats"] as $stat) {
                if ($stat['stat']['name'] === 'hp') $pokedexModel->stat_hp = $stat['base_stat'];
                if ($stat['stat']['name'] === 'attack') $pokedexModel->stat_attack = $stat['base_stat'];
                if ($stat['stat']['name'] === 'defense') $pokedexModel->stat_defense = $stat['base_stat'];
                if ($stat['stat']['name'] === 'special-attack') $pokedexModel->stat_special_attack = $stat['base_stat'];
                if ($stat['stat']['name'] === 'special-attack') $pokedexModel->stat_special_defense = $stat['base_stat'];
                if ($stat['stat']['name'] === 'speed') $pokedexModel->stat_speed = $stat['base_stat'];
            }

            //==============TODO==============//
            // type-prime
            // type-second
            //==============TODO==============//


            $responseSpecies = Http::get('https://pokeapi.co/api/v2/pokemon-species/' . $i);
            $pokemonSpecies = $responseSpecies->json();

            // description
            foreach ($pokemonSpecies['flavor_text_entries'] as $description) {
                if ($description['language']['name'] === self::LANGUAGE) {
                    $pokedexModel->description = $description['flavor_text'];
                    break;
                }
            }

            // name
            foreach ($pokemonSpecies['names'] as $name) {
                if ($name['language']['name'] === self::LANGUAGE) {
                    $pokedexModel->name = $name['name'];
                    break;
                }
            }

            // category
            foreach ($pokemonSpecies['genera'] as $category) {
                if ($category['language']['name'] === self::LANGUAGE) {
                    $pokedexModel->category = $category['genus'];
                    break;
                }
            }

            // evolve_from 
            if (!is_null($pokemonSpecies['evolves_from_species'])) {
                $evolvesFromUrl = $pokemonSpecies['evolves_from_species']['url'];
                $responseEvolvesFrom = Http::get($evolvesFromUrl);
                $evolvesFromData = $responseEvolvesFrom->json();
                foreach ($evolvesFromData['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $pokedexModel->evolve_from = $name['name'];
                        break;
                    }
                }
            } else {
                $pokedexModel->evolve_from = null;
            }

            // evolve_to
            $responseEvolution = Http::get($pokemonSpecies['evolution_chain']['url']);
            $evolutionChain = $responseEvolution->json();

            // Find the next evolution stage
            $currentPokemon = $evolutionChain['chain'];
            while ($currentPokemon['species']['name'] !== $pokemonSpecies['name']) {
                $currentPokemon = $currentPokemon['evolves_to'][0] ?? null;
                if (!$currentPokemon) {
                    break;
                }
            }

            // If evolves_to is not empty, retrieve the next Pokémon's name in French
            if (!empty($currentPokemon['evolves_to'])) {
                $nextEvolutionUrl = $currentPokemon['evolves_to'][0]['species']['url'];
                $responseEvolvesTo = Http::get($nextEvolutionUrl);
                $evolvesToData = $responseEvolvesTo->json();
                foreach ($evolvesToData['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $pokedexModel->evolve_to = $name['name'];
                        break;
                    }
                }
            } else {
                $pokedexModel->evolve_to = null;
            }

            $pokedexModel->save();

            echo ('pokemon : ' . $i . "\n");
        }

        echo 'Gen I pokemons successfully added to DB';
    }
}
