<?php

namespace Database\Seeders;

use App\Models\Attack;
use App\Models\Pokemon;
use App\Models\Type;
use App\Models\Weaknesses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PokemonSeeder extends Seeder
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

            $pokemonModel = new Pokemon();

            // Get the attack from POKéAPI
            $responsePokemon = Http::get('https://pokeapi.co/api/v2/pokemon/' . $i);
            $pokemon = $responsePokemon->json();

            // Number
            $pokemonModel->number = $pokemon['id'];

            // Image_artwork
            $pokemonModel->image_artwork = $pokemon['sprites']['other']['official-artwork']['front_default'];

            // Image_front
            $pokemonModel->image_front = $pokemon['sprites']['front_default'];

            // Image_back
            $pokemonModel->image_back = $pokemon['sprites']['back_default'];

            // Height
            $heightUnformatted = $pokemon['height'];
            $pokemonModel->height = $this->convertNumber($heightUnformatted, 'dm', 'm');


            // Weight
            $weightUnformatted = $pokemon['weight'];
            $pokemonModel->weight = $this->convertNumber($weightUnformatted, 'dg', 'kg');

            // Cry
            $pokemonModel->cry = $pokemon['cries']['legacy'];

            // Stats
            foreach ($pokemon["stats"] as $stat) {
                if ($stat['stat']['name'] === 'hp') $pokemonModel->stat_hp = $stat['base_stat'];
                if ($stat['stat']['name'] === 'attack') $pokemonModel->stat_attack = $stat['base_stat'];
                if ($stat['stat']['name'] === 'defense') $pokemonModel->stat_defense = $stat['base_stat'];
                if ($stat['stat']['name'] === 'special-attack') $pokemonModel->stat_special_attack = $stat['base_stat'];
                if ($stat['stat']['name'] === 'special-defense') $pokemonModel->stat_special_defense = $stat['base_stat'];
                if ($stat['stat']['name'] === 'speed') $pokemonModel->stat_speed = $stat['base_stat'];
            }


            // Types
            $countType = 0;

            foreach ($pokemon['types'] as $type) {
                $typeNamesUrl = $type['type']['url'];
                $typeNamesReq = Http::get($typeNamesUrl);
                $typeNames = $typeNamesReq->json();
                foreach ($typeNames['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $retrivedTypeName = $name['name'];
                        $typeId = Type::where('name', $retrivedTypeName)->first();
                        $countType === 0 ? $pokemonModel->type_prime_id = $typeId->id : $pokemonModel->type_second_id = $typeId->id; // type_prime_id and type_second_id
                        $countType++;
                    }
                }
            }

            // Get additional Pokemon info
            $responseSpecies = Http::get('https://pokeapi.co/api/v2/pokemon-species/' . $i);
            $pokemonSpecies = $responseSpecies->json();

            // Description
            foreach ($pokemonSpecies['flavor_text_entries'] as $description) {
                if ($description['language']['name'] === self::LANGUAGE) {
                    $pokemonModel->description = $description['flavor_text'];
                    break;
                }
            }

            // Name
            foreach ($pokemonSpecies['names'] as $name) {
                if ($name['language']['name'] === self::LANGUAGE) {
                    $pokemonModel->name = $name['name'];
                    break;
                }
            }

            // Category
            foreach ($pokemonSpecies['genera'] as $category) {
                if ($category['language']['name'] === self::LANGUAGE) {
                    $pokemonModel->category = $category['genus'];
                    break;
                }
            }

            // Evolve_from
            if (!is_null($pokemonSpecies['evolves_from_species'])) {
                $evolvesFromUrl = $pokemonSpecies['evolves_from_species']['url'];
                $responseEvolvesFrom = Http::get($evolvesFromUrl);
                $evolvesFromData = $responseEvolvesFrom->json();
                foreach ($evolvesFromData['names'] as $name) {
                    if ($name['language']['name'] === self::LANGUAGE) {
                        $pokemonModel->evolve_from = $name['name'];
                        break;
                    }
                }
            } else {
                $pokemonModel->evolve_from = null;
            }

            // Evolve_to
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
                        $pokemonModel->evolve_to = $name['name'];
                        break;
                    }
                }
            } else {
                $pokemonModel->evolve_to = null;
            }

            $pokemonModel->save();

            // Attacks
            foreach ($pokemon['moves'] as $move) {
                $moveNamesUrl = $move['move']['url'];

                $response = Http::get($moveNamesUrl);

                if ($response->successful()) {
                    $moveData = $response->json();

                    if ($moveData['generation']['name'] === 'generation-i') {
                        foreach ($moveData['names'] as $moveName) {
                            if ($moveName['language']['name'] === self::LANGUAGE) {
                                $retrievedMoveName = $moveName['name'];
                                $attack = Attack::where('name', $retrievedMoveName)->first();

                                if ($attack) {
                                    $pokemonModel->attacks()->attach($attack->id);
                                }

                                break;
                            }
                        }
                    }
                } else {
                    echo 'Error when retreiving data from URL: ' . $moveNamesUrl . PHP_EOL;
                }
            }

            echo ('pokemon : ' . $i . "\n");

        }

        echo 'Gen I Pokemon successfully added to DB';
    }
}
